<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
use App\Notifications\NewUserNotification;

class NotifyNewUserJob implements ShouldQueue
{
    use Queueable;

    protected User $user;
    protected $delayTime;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, $delay = 0)
    {
        $this->user = $user;
        $this->delayTime = $delay;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new NewUserNotification($this->user, $this->delayTime));
    }
}