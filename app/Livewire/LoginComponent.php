<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class LoginComponent extends Component
{
    public $email, $password;

    public function getDatauser(){
        return DB::table('users')->where('email', $this->email)->first();
    }
    public function login(){
        //log in logic
        if($this->getDatauser() and Hash::check($this->password, $this->getDatauser()->password ) and $this->email == $this->getDatauser()->email) {
           session([
               'id' => $this->getDatauser()->id,
               'role_id'=> $this->getDatauser()->role_id
           ]);
        //    dd('oke');
           redirect('/cms/dashboard');
        //    $this->redirect('/cms/dashboard', navigate: true);

        }else{
            // dd('ok');
            Toaster::error('check your login information');
        }
    }
    public function render()
    {
        return view('livewire.login-component');
    }
}
