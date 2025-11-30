<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class TaskCreatedMail extends Mailable
{
    use Queueable;

    public function __construct(public Task $task)
    {
    }

    public function build()
    {
        return $this->subject('New Task Assigned')
            ->view('emails.task-created')
            ->with(['task' => $this->task]);
    }
}
