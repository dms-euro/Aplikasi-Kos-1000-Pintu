<?php

namespace App\Console\Commands;

use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CekPemesananExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cek-pemesanan-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredTime = Carbon::now()->subHours(24);

        $pemesanans = Pemesanan::where('status', 'pending')
            ->where('created_at', '<=', $expiredTime)
            ->get();

        foreach ($pemesanans as $pemesanan) {

            // Ubah status pemesanan jadi batal
            $pemesanan->update([
                'status' => 'cancelled'
            ]);

            // Kembalikan status kamar jadi tersedia
            $pemesanan->kamar->update([
                'status' => 'tersedia'
            ]);
        }

        $this->info('Pemesanan expired berhasil dicek.');
    }
}
