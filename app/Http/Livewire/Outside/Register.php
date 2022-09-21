<?php

namespace App\Http\Livewire\Outside;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;




class Register extends Component
{

    public $userName;
    public $password;
    public $confirmPassword;
    public $submitted;

    protected $rules = [
        'userName'=>'required',
        'password'=>'required',
        'confirmPassword'=>'required'
    ];

    public function updated($userName){
        $this->validateOnly($userName);
    }

    public function submitted(){
        if($this->userName == "" || $this->password == "" || $this->confirmPassword == ""){
            session()->flash('error','Please finish filling the form');
            return;
        }

        elseif($this->password != "" && $this->password != ""){
            //Check if password and confirmPassword are equal
            if($this->password == $this->confirmPassword){
                
                //Check the length of password
                $length = str::length($this->password);
                if($length < 8){
                    session()->flash('error','Password must be at least eight characters');
                    return;
                }

                else{
                     //Create user
                User::create([
                    'name'=>$this->userName,
                    'password'=>Hash::make($this->password)
                ]);
                
                
                //redirect user to the login page
                return redirect()->to('/')->with('success','Now you can Log in and enjoy!');

                }

                

            
            }

            else{
                session()->flash('error','Please confirm correct');
                return;
            }

        }
    }
   

    

    public function render()
    {
        return view('livewire.outside.register')->extends('livewire.outside.register');
    }
}
