<?php

namespace App\Http\Livewire\Outside;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $name;
    public $password;

    //Validate input
    protected $rules = [
        'name'=>'required',
        'password'=>'required'
    ];

    public function updated($name){
        $this->validateOnly($name);
    }

    public function login(){
        if($this->name == "" || $this->password == ""){
            session()->flash('error','Please finish filling the form');
            return;
        }

        else{
            //Aunthenticate user
            $credentials = $this->validate([
                'name' => 'required',
                'password' => 'required',
            ]);

            

            if(Auth::attempt($credentials)){
                
                session()->regenerate();
                return redirect()->to('home');

            }

            else{
                session()->flash('error','Incorrect user name or password');
            }

        }
    }
    public function render()
    {
        
        return view('livewire.outside.login');
    }
}
