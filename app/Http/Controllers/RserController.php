<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
class RserController extends Controller
{
    public function sendEmailToUser() {

        $to_email = "antimanongmin1@gmail.com";

        Mail::to($to_email)->send(new SendEmail);

        return "<p> Your E-mail has been sent successfully. </p>";

    }
}
