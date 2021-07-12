<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\TestEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TestEnrollmentController extends Controller
{
    public function sendTestNotification()
    {
        $user = User::first();

        $enrollmentData = [
            'body' => ' Hai ricevuto una nuova test notification',
            'enrollmentText' => 'Puoi iscriverti',
            'url' => url('/'),
            'thankyou' => 'Hai 14 giorni per iscriverti',
        ];

        //$user->notify(new TestEnrollment($enrollmentData));
        Notification::send($user, new TestEnrollment($enrollmentData));
    }
}
