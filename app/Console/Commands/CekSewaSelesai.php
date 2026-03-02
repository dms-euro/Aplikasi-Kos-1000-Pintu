<?php

namespace App\Console\Commands;

use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CekSewaSelesai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cek-sewa-selesai';

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
        $expired = Pemesanan::where('status', 'aktif')
            ->where('tanggal_keluar', '<', Carbon::now())
            ->get();

        foreach ($expired as $pemesanan) {

            // Kamar kembali tersedia
            $pemesanan->kamar->update([
                'status' => 'tersedia'
            ]);
        }

        $this->info('Sewa selesai berhasil dicek.');
    }
}
