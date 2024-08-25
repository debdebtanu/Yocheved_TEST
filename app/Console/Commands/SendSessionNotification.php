<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Modules\Student\Models\Student;
use App\Notifications\SessionNotification;
use App\Modules\Student\Models\StudentSession;

class SendSessionNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-session-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Session Notification';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::find(1);
        $nextTime = date('H:i:s', strtotime("+5 min"));
        $currentDate = date('Y-m-d');
        $sessions = StudentSession::with(['student'])->where('date', $currentDate)->where('start_time', "<=" ,$nextTime)->where('is_notified', '0')->get();
        if (is_object($sessions)) {
            foreach ($sessions as $session) {
                $student = $session->student;
                $student->notify(new SessionNotification($session));
                $user->notify(new SessionNotification($session));
                $session->update(['is_notified' => true]);
            }
        }
    }
}
