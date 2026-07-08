<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function dailySales(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));

        $sales = Order::accepted()
            ->whereDate('verified_at', $date)
            ->with('user')
            ->get();

        $totalRevenue = $sales->sum('amount');

        return view('admin.reports.daily', compact('sales', 'totalRevenue', 'date'));
    }

    public function monthlySales(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $sales = Order::accepted()
            ->whereMonth('verified_at', $month)
            ->whereYear('verified_at', $year)
            ->with('user')
            ->get();

        $totalRevenue = $sales->sum('amount');
        $salesByTier = $sales->groupBy('tier_purchased')->map(fn($items) => $items->sum('amount'));

        return view('admin.reports.monthly', compact('sales', 'totalRevenue', 'salesByTier', 'month', 'year'));
    }

    public function yearlySales(Request $request)
    {
        $year = $request->input('year', now()->year);

        $sales = Order::accepted()
            ->whereYear('verified_at', $year)
            ->with('user')
            ->get();

        $totalRevenue = $sales->sum('amount');
        $salesByMonth = $sales->groupBy(fn($order) => $order->verified_at->format('F'))
            ->map(fn($items) => $items->sum('amount'));

        return view('admin.reports.yearly', compact('sales', 'totalRevenue', 'salesByMonth', 'year'));
    }

    public function customerData()
    {
        $userData = [
            'total_users' => User::count(),
            'by_role' => [
                'admin' => User::admin()->count(),
                'pengajar' => User::pengajar()->count(),
                'peserta' => User::peserta()->count(),
            ],
            'by_tier' => [
                'free' => User::byTier('free')->count(),
                'apik' => User::byTier('apik')->count(),
                'sangar' => User::byTier('sangar')->count(),
            ],
            'active_users' => User::active()->count(),
            'inactive_users' => User::where('is_active', false)->count(),
        ];

        $recentRegistrations = User::latest()->take(20)->get();

        return view('admin.reports.customers', compact('userData', 'recentRegistrations'));
    }

    public function totalRevenue()
    {
        $allTimeRevenue = Order::accepted()->sum('amount');
        $thisYearRevenue = Order::accepted()->whereYear('verified_at', now()->year)->sum('amount');
        $thisMonthRevenue = Order::accepted()
            ->whereMonth('verified_at', now()->month)
            ->whereYear('verified_at', now()->year)
            ->sum('amount');

        $revenueByTier = Order::accepted()
            ->selectRaw('tier_purchased, SUM(amount) as total')
            ->groupBy('tier_purchased')
            ->get()
            ->pluck('total', 'tier_purchased');

        return view('admin.reports.revenue', compact(
            'allTimeRevenue',
            'thisYearRevenue',
            'thisMonthRevenue',
            'revenueByTier'
        ));
    }
}
