<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CancelExpiredOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel pending orders that have passed the 15-minute payment time limit and restock offers.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Checking for expired pending orders...');

        $expirationTime = Carbon::now()->subMinutes(15);

        $expiredOrders = Order::where('status', 'pending_payment')
            ->where('created_at', '<=', $expirationTime)
            ->get();

        if ($expiredOrders->isEmpty()) {
            $this->info('No expired pending orders found.');
            return Command::SUCCESS;
        }

        $cancelledCount = 0;
        foreach ($expiredOrders as $order) {
            DB::beginTransaction();
            try {
                $order->status = 'cancelled';
                // Anda bisa menambahkan field 'cancelled_at' atau 'cancellation_reason' jika perlu
                // $order->cancellation_reason = 'Payment timed out';
                $order->save();

                $offer = $order->offer;
                if ($offer) {
                    $offer->increment('quantity_remaining');
                    // Pastikan quantity_remaining tidak melebihi quantity_initial
                    if ($offer->quantity_remaining > $offer->quantity_initial) {
                        $offer->quantity_remaining = $offer->quantity_initial;
                        $offer->save();
                    }
                }

                DB::commit();
                $cancelledCount++;
                Log::info("Order {$order->order_code} cancelled due to payment timeout. Offer ID {$offer->id} restocked.");
                $this->info("Order {$order->order_code} cancelled. Offer ID {$offer->id} restocked.");
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Failed to cancel order {$order->order_code}: " . $e->getMessage());
                $this->error("Failed to cancel order {$order->order_code}: " . $e->getMessage());
            }
        }

        $this->info("Finished. {$cancelledCount} orders were cancelled.");
        return Command::SUCCESS;
    }
}
