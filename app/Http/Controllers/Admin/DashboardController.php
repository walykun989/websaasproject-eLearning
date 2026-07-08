<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_peserta' => User::peserta()->count(),
            'total_pengajar' => User::pengajar()->count(),
            'premium_users' => User::where('tier', '!=', 'free')->count(),
            'total_courses' => Course::count(),
            'active_courses' => Course::active()->count(),
            'pending_payments' => Order::pendingVerification()->count(),
            'total_revenue' => Order::accepted()->sum('amount'),
            'this_month_revenue' => Order::accepted()
                ->whereMonth('verified_at', now()->month)
                ->whereYear('verified_at', now()->year)
                ->sum('amount'),
        ];

        $recentOrders = Order::with('user')
            ->latest()
            ->take(10)
            ->get();

        $recentUsers = User::peserta()
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentUsers'));
    }
}
