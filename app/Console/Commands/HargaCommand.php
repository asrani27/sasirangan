<?php

namespace App\Console\Commands;

use App\Harga;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HargaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'perbaikanharga {--tanggal=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perbaikan harga 0';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tanggal = $this->option('tanggal');

        if (!$tanggal) {
            $this->error('Parameter --tanggal harus diisi. Contoh: php artisan perbaikanharga --tanggal=2024-04-26');
            return 1;
        }

        $tglKemarin = Carbon::parse($tanggal)->subDay(1)->format('Y-m-d');

        $this->info("Memulai proses perbaikan harga...");
        $this->info("Tanggal Target  : {$tanggal}");
        $this->info("Tanggal Kemarin : {$tglKemarin}");

        $data = Harga::where('tanggal', $tanggal)->get();
        $total = $data->count();

        $this->info("Total data ditemukan: {$total}");

        if ($total === 0) {
            $this->warn("Tidak ada data harga yang ditemukan pada tanggal {$tanggal}.");
            return 0;
        }

        $updated = 0;
        $skipped = 0;

        foreach ($data as $key => $i) {
            $prev = Harga::where('tanggal', $tglKemarin)
                ->where('bahan_id', $i->bahan_id)
                ->where('pasar_id', $i->pasar_id)
                ->first();

            if ($prev) {
                $hargaSebelumnya = $prev->harga;
                $hargaLama = $i->harga;
                $i->update(['harga' => $hargaSebelumnya]);
                $this->line("[" . ($key + 1) . "/{$total}] Pasar ID: {$i->pasar_id}, Bahan ID: {$i->bahan_id} | Harga lama: {$hargaLama} -> Harga baru: {$hargaSebelumnya}");
                $updated++;
            } else {
                $this->warn("[" . ($key + 1) . "/{$total}] Pasar ID: {$i->pasar_id}, Bahan ID: {$i->bahan_id} | Data tanggal {$tglKemarin} tidak ditemukan.");
                $skipped++;
            }
        }

        $this->info("Perbaikan harga selesai! (Diperbarui: {$updated}, Dilewati: {$skipped})");

        return 0;
    }
}
