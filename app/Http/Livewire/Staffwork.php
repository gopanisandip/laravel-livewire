<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\TaskImages;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Staffwork extends Component
{
    public $task , $search;
    
   public $decodedResponse = [];
   public $selectedImages = [];

    public function SearchImage(){
        // dd($this->search);

        $queryFields = [
            "query" => $this->search
          ];
          $SHUTTERSTOCK_API_TOKEN =  env('SHUTTERSTOCK_API_TOKEN');

          $options = [
            CURLOPT_URL => "https://api.shutterstock.com/v2/images/search?" . http_build_query($queryFields),
            CURLOPT_USERAGENT => "php/curl",
            CURLOPT_HTTPHEADER => [
              "Authorization: Bearer $SHUTTERSTOCK_API_TOKEN"
            ],
            CURLOPT_RETURNTRANSFER => 1
          ];
          
          $handle = curl_init();
          curl_setopt_array($handle, $options);
          $response = curl_exec($handle);
          curl_close($handle);
          
          $this->decodedResponse = json_decode($response, true);

        //  dd($this->decodedResponse);
    }


    public function TaskEnd(){
        $this->task = Task::where('worked_by',Auth::user()->id)->first();
        // dd($this->task);
        if(count($this->selectedImages) !== $this->task->no_image){
            session()->flash('error', 'Image Selected Not Match With Current Task.');
        }else{
            foreach ($this->selectedImages as $image_id) {
                $taskimage = new TaskImages();
                $taskimage->post_id = $this->task->id;
                $taskimage->image_id = $image_id;
                $taskimage->save();
            }
            $Task = Task::updateOrCreate(
                [
                   'id'   => $this->task->id,
                ],
                [
                   'worked_done_at'     => now(),                   
                ],
            );
            session()->flash('message', 'Task Has Been Successfully Done.');
            return redirect('staff/tasks');

        }
        // dd(count($this->selectedImages),$this->task->no_image);
    }

    public function render()
    {
        $this->task = Task::where('worked_by',Auth::user()->id)->first();
        
        return view('livewire.work');
    }
}
