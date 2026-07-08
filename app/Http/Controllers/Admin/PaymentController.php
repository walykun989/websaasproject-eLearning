<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $pendingPayments = Order::with('user')
            ->pendingVerification()
            ->latest()
            ->paginate(15);

        return view('admin.payments.index', compact('pendingPayments'));
    }

    public function show(Order $order)
    {
        $order->load('user');
        return view('admin.payments.show', compact('order'));
    }

    public function verify(Order $order)
    {
        if ($order->status !== 'pending_verification') {
            return back()->with('error', 'Order is not pending verification');
        }

        $order->markAsVerified(auth()->user());

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment verified successfully. User tier updated to ' . $order->tier_purchased);
    }

    public function reject(Request $request, Order $order)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        if ($order->status !== 'pending_verification') {
            return back()->with('error', 'Order is not pending verification');
        }

        $order->reject(auth()->user(), $request->rejection_reason);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment rejected successfully');
    }
}
