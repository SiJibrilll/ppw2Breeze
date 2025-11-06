<?php

namespace App\Jobs;

use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use Queueable;

    public User $user;
    /**
     * Create a new job instance.
     */
    public function __construct(
        User $userInput
    )
    {
        $this->user = $userInput;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        Mail::to($this->user->email)->send(new SendMail($this->user));
    }
}
