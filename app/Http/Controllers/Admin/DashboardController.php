<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_announcements' => Announcement::count(),
            'active_announcements' => Announcement::where('status', 'active')->count(),
            'total_users' => User::count(),
            'admin_users' => User::where('role', 'admin')->count(),
        ];

        $recent_announcements = Announcement::latest()->take(5)->get();

        return view('CRUD.dashboard', compact('stats', 'recent_announcements'));
    }
}
