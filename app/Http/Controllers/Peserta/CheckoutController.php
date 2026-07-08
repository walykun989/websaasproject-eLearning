<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function pricing()
    {
        $paywall = session('paywall', false);
        $materialId = session('material_id');

        return view('peserta.checkout.pricing', compact('paywall', 'materialId'));
    }

    public function checkout($tier)
    {
        if (!in_array($tier, ['apik', 'sangar'])) {
            abort(404);
        }

        $amount = $tier === 'apik' ? 12345 : 67891;

        return view('peserta.checkout.checkout', compact('tier', 'amount'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'tier' => 'required|in:apik,sangar',
        ]);

        $tier = $request->tier;
        $amount = $tier === 'apik' ? 12345 : 67891;

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => $this->generateOrderNumber(),
            'tier_purchased' => $tier,
            'amount' => $amount,
            'status' => 'pending_payment',
            'expires_at' => now()->addDay(),
        ]);

        return view('peserta.checkout.payment-instructions', compact('order'));
    }

    public function uploadProof(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($order->status !== 'pending_payment') {
            return back()->with('error', 'Payment proof has already been submitted');
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        $order->update([
            'payment_proof' => $path,
            'status' => 'pending_verification',
        ]);

        return redirect()->route('peserta.orders.index')
            ->with('success', 'Payment proof uploaded successfully. Waiting for admin verification.');
    }

    private function generateOrderNumber(): string
    {
        return 'WIB-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }
}
