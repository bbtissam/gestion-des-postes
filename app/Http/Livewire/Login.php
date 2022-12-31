<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules=[
      
        'email'=>"required",
        'password' => 'required|min:6', 

    ];

    protected $messages = [
        'name.required' => 'le champ nom est obligatoire',
        'email.required' => 'le champ email est obligatoire',
        'password.required' => 'le champ password est obligatoire',

    ];

    public function mount(){
        if(auth()->check()){
            redirect("/");
        }
    }

    public function login(){
    Auth::attempt([
            'email'=>$this->email,
            'password'=>$this->password]);
        if (Auth::check()){
        
        
        return redirect("/");
        }
        else{
        session()->flash('message', 'User doesn\'t exist.');
        }
     
    }
    public function render()
    {
        return view('livewire.login');
    }
}
