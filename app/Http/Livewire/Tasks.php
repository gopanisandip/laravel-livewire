<?php
  
namespace App\Http\Livewire;

use App\Models\Task;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Http\Request;
  
class Tasks extends Component
{
    public $tasks, $title, $task_id, $no_image, $description,$search;
    public $updateMode = false;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->posts = Task::all();
        return view('livewire.tasks');
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->title = '';
        $this->no_image = '';
        $this->description = '';
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $validatedDate = $this->validate([
            'title' => 'required',
            'no_image' => 'required',
            'description' => 'required',
        ]);
  
        Task::create($validatedDate);
  
        session()->flash('message', 'Task Created Successfully.');
  
        $this->resetInputFields();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $this->task_id = $id;
        $this->title = $task->title;
        $this->no_image = $task->no_image;
        $this->description = $task->description;  
        $this->updateMode = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function update()
    {
        $validatedDate = $this->validate([
            'title' => 'required',
            'no_image' => 'required',
            'description' => 'required',
        ]);
  
        $task = Task::find($this->task_id);
        $task->update([
            'title' => $this->title,
            'no_image' => $this->no_image,
            'description' => $this->description,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Task Updated Successfully.');
        $this->resetInputFields();
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Task::find($id)->delete();
        session()->flash('message', 'Task Deleted Successfully.');
    }

    public function Starttask($id){
        $user = Auth::user();
        $task = Task::where('id', $id)->first();

        if(!$task){
            return abort(404);
        }

        if(!empty($task->worked_by)){

            if(!empty($task->worked_done_at)){
                session()->flash('error', 'Task is already finished.');    
            }else{
                session()->flash('error', 'Task is already started by another person');
            }

        }else{

            $checkOtherTaskInProgress = Task::where('id','<>', $id)->where('worked_by', $user->id)->whereNull('worked_done_at')->first();

            if($checkOtherTaskInProgress){
                session()->flash('error', 'You already have another task in progress. Please finish that task first before starting new one.');
            }else{
                $task->worked_by = Auth::user()->id;
                $task->save();
                // return redirect('staff/tasks/work');
                 return redirect()->to('staff/tasks/'.$task->id);
            }
        }

        
    }
  
}
