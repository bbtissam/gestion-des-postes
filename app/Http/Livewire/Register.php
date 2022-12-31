<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Foundation\Auth\User;

class Register extends Component
{
    public $name;
    public $email;
    public $password;

    protected $rules=[
        'name'=>"required||min:3",
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

    public function register(){
        $this->validate();
        $user=new User();
        $user->name=$this->name;
        $user->email=$this->email;
        $user->password=bcrypt($this->password);
        $user->save();
        $this->name="";
        $this->email="";
        $this->password="";
        session()->flash('message', 'User successfully created.');
 
     }


    public function render()
    {
        return view('livewire.register');
    }
}
