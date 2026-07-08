<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class CancelExpiredOrders extends Command
{
    protected $signature = 'orders:cancel-expired';
    protected $description = 'Cancel orders that have passed their expiry date';

    public function handle(): void
    {
        $count = Order::whereIn('status', ['pending_payment', 'pending_verification'])
            ->where('expires_at', '<=', now())
            ->update(['status' => 'cancelled']);

        $this->info("Cancelled {$count} expired order(s).");
    }
}
