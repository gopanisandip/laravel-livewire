<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginRegister extends Component
{
    public $users, $email, $password, $first_name,$last_name;
    public $registerForm = false;

    public function render()
    {
        return view('livewire.login-register');
    }

    private function resetInputFields(){
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->password = '';
    }

    public function login()
    {
        $validatedDate = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(\Auth::attempt(array('email' => $this->email, 'password' => $this->password))){
                // session()->flash('message', "You are Login successful.");
                   $user = User::where('email',$this->email)->pluck('role_id')->first();
                   if($user == 2){
                        return redirect('staff/tasks');
                   }else{
                        return redirect('admin/tasks');
                   }
        }else{
            session()->flash('error', 'email and password are wrong.');
        }
    }

    public function register()
    {
        $this->registerForm = !$this->registerForm;
    }

    public function registerStore()
    {
        $validatedDate = $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $this->password = Hash::make($this->password); 

        User::create(['role_id' => "2", 'first_name' => $this->first_name, 'last_name' => $this->last_name, 'email' => $this->email,'password' => $this->password]);

        session()->flash('message', 'Your register successfully Go to the login page.');
        $this->resetInputFields();
        return redirect('staff/tasks');



    }
}