<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotif implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $nomor = Notifikasi::first()->nomor;
        $pesan = [
            "phoneNumber" => $nomor,
            "content" => [
                "text" => Carbon::now()->translatedFormat('d F Y') .
                    " \nEarly Warning system (EWS), \n Harga Bahan Pokok Yang mengalami Kenaikan : \n Link : https://dedikasibaiman.banjarmasinkota.go.id/kenaikan \n",
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjhlMTE4NmUzLWJkZTEtNDhlYi05MzAxLTY1ZGQ5MzIzNjdiNiIsImlhdCI6MTY4NjI3MjY3M30.KvyD0cCvAQNFC8V4e0ZsZ3eR4M6nKZeC5JCov_yhHXI',
        ])->withBody(json_encode($pesan), 'application/json')->post('https://api.wa.banjarmasinkota.go.id/whatsapp/8e1186e3-bde1-48eb-9301-65dd932367b6/messages');
    }
}
