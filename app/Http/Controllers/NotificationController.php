<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');
        // Ambil notifikasi yang due_date-nya dari hari ini sampai 2 hari ke depan
        $dayaftertomorrow = now()->addDays(2)->format('Y-m-d');
        $notifications = Auth::user()->tasks()->where('due_date' , '>=', $today)->where('due_date', '<=', $dayaftertomorrow)->get();
        return view('notifications.index', compact('notifications'));
    }
}
