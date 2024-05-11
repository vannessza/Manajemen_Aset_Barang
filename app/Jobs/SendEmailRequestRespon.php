<?php

namespace App\Jobs;

use App\Mail\requestPeminjaman;
use App\Mail\SendEmail;
use App\Mail\SendRequest;
use App\Mail\SendRequestrespo;
use App\Mail\SendRequestrespon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailRequestRespon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new SendRequestrespon($this->data);
        Mail::to($this->data['email'])->send($email);
    }
}
