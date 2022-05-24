<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;


/**
 * Use this for all test code purposes
 */
class TestController extends Controller
{
    public function sendEmail(){
        $to = 'azmeer.sc@gmail.com';
        $details = [
            'subject' => 'This is the subject.',
            'body' => 'This is the email body.'
        ];
    
        Mail::to($to)->send(new WelcomeMail($details));
    
        dd("Mail Send Successfully");
    
    }
}
