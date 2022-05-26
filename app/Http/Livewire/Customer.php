<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Customer extends Component
{
    public $first_name = "";
    public $last_name = "";
    public $email = "";
    public $phone = "";
    public $dob = "";
    public $gender = "";
    public $password = "";
    public $confirm_password = "";

    public function mount()
    {
        $this->first_name = "Hello";
    }

    public function register()
    {
        dd("p");
    }

    public function updatedRegisterBack($a)
    {
        dd($a);
    }

    public function accountNext()
    {
        dd("ok");
    }

    public function render()
    {
        return view('livewire.customer');
    }
}
