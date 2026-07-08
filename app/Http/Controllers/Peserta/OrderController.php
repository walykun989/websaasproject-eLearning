<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->latest()
            ->paginate(15);

        return view('peserta.orders.index', compact('orders'));
    }
}
