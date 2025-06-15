<?php

namespace App\Console\Commands;

use App\Models\Offer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateOfferStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-offer-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status of offers that have passed their pickup end time to inactive';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to update offer statuses...');
        Log::info('Scheduled task: UpdateOfferStatus - Starting.');

        $now = now();
        $updatedCount = 0;

        // Cari penawaran yang:
        // 1. Waktu selesai pengambilannya sudah lewat
        // 2. Statusnya masih 'active' (atau status lain yang relevan yang ingin diubah)
        $offersToUpdate = Offer::where('pickup_end_time', '<', $now)
            ->whereIn('status', ['active']) // Hanya ubah yang aktif
            ->get();

        if ($offersToUpdate->isEmpty()) {
            $this->info('No offers found that need status updates.');
            Log::info('Scheduled task: UpdateOfferStatus - No offers to update.');
            return 0; // Mengindikasikan tidak ada yang diubah atau sukses tanpa perubahan
        }

        foreach ($offersToUpdate as $offer) {
            $offer->status = 'inactive'; // Atau bisa juga 'expired' jika Anda ingin status khusus
            // Jika Anda ingin juga mengosongkan quantity_remaining, bisa ditambahkan di sini:
            // $offer->quantity_remaining = 0;
            $offer->save();
            $updatedCount++;
            $this->line("Offer '{$offer->name}' (ID: {$offer->id}) status updated to inactive.");
            Log::info("Scheduled task: UpdateOfferStatus - Offer ID {$offer->id} status updated to inactive.");
        }

        $this->info("Successfully updated status for {$updatedCount} offer(s).");
        Log::info("Scheduled task: UpdateOfferStatus - Finished. Updated {$updatedCount} offer(s).");
        return 0; // Mengindikasikan sukses
    }
}
