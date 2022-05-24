<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;


/**
 * Use this for all help screen purposes
 */
class HelpController extends Controller
{
    public function index(){
        return view('backend.help.view');
    
    }
}
