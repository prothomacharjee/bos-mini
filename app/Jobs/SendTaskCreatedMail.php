<?php

namespace App\Jobs;

use App\Models\Task;
use App\Mail\TaskCreatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendTaskCreatedMail implements ShouldQueue
{
    use Queueable, Dispatchable;

    public function __construct(public Task $task) {}

    public function handle(): void
    {
        Mail::to($this->task->user->email)
            ->send(new TaskCreatedMail($this->task));
    }
}
