<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmail;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    function sendMail() {
        $user = User::find(1);
        SendWelcomeEmail::dispatch($user);

        return 'Pesan berhasil dikirim';
    }
}
