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
        // dd('ok');
    }

    public function cool()
    {
        dd('cool');
    }

    public function render()
    {
        return view('livewire.customer');
    }
}
