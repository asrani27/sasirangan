<?php

namespace Tests\Feature;

use App\Bahan;
use Carbon\Carbon;
use Tests\TestCase;

class InfoHargaBahanTest extends TestCase
{
    public function testInfoHargaBahanWithValidFilter()
    {
        $bahan = Bahan::first();
        $tanggal = '2026-10-11';

        $response = $this->getJson("/api/info-harga/bahan?bahan_id={$bahan->id}&tanggal={$tanggal}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Harga Bahan Berdasarkan Pasar Ditemukan',
                'nama_bahan' => $bahan->nama,
                'bahan' => [
                    'id' => $bahan->id,
                    'nama' => $bahan->nama,
                ],
                'tanggal' => $tanggal,
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'nama_bahan',
                'bahan' => ['id', 'nama', 'satuan'],
                'tanggal',
                'total_pasar',
                'data' => [
                    '*' => [
                        'id',
                        'nama',
                        'harga',
                        'formatted',
                    ]
                ]
            ]);

        $data = $response->json('data');
        $this->assertNotEmpty($data);

        // Verify sorted by harga descending (and nama ascending on tie)
        for ($i = 0; $i < count($data) - 1; $i++) {
            $this->assertGreaterThanOrEqual(
                $data[$i + 1]['harga'],
                $data[$i]['harga'],
                "Harga at index {$i} ({$data[$i]['harga']}) should be >= harga at index " . ($i + 1) . " ({$data[$i + 1]['harga']})"
            );

            if ($data[$i]['harga'] === $data[$i + 1]['harga']) {
                $this->assertLessThanOrEqual(
                    0,
                    strcmp($data[$i]['nama'], $data[$i + 1]['nama']),
                    "When harga is equal, nama at index {$i} ({$data[$i]['nama']}) should precede index " . ($i + 1) . " ({$data[$i + 1]['nama']})"
                );
            }
        }
    }

    public function testInfoHargaBahanViaPasarEndpoint()
    {
        $bahan = Bahan::first();
        $tanggal = '2026-10-11';

        $response = $this->getJson("/api/info-harga/pasar?bahan_id={$bahan->id}&tanggal={$tanggal}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Harga Bahan Berdasarkan Pasar Ditemukan',
                'nama_bahan' => $bahan->nama,
                'bahan' => [
                    'id' => $bahan->id,
                    'nama' => $bahan->nama,
                ],
                'tanggal' => $tanggal,
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'nama_bahan',
                'bahan' => ['id', 'nama', 'satuan'],
                'tanggal',
                'total_pasar',
                'data' => [
                    '*' => [
                        'id',
                        'nama',
                        'harga',
                        'formatted',
                    ]
                ]
            ]);

        $data = $response->json('data');
        $this->assertNotEmpty($data);

        // Verify highest price is first
        $this->assertGreaterThanOrEqual($data[count($data) - 1]['harga'], $data[0]['harga']);
    }

    public function testInfoHargaBahanViaBaseInfoHargaEndpoint()
    {
        $bahan = Bahan::first();
        $tanggal = '2026-10-11';

        $response = $this->getJson("/api/info-harga?bahan_id={$bahan->id}&tanggal={$tanggal}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Harga Bahan Berdasarkan Pasar Ditemukan',
                'nama_bahan' => $bahan->nama,
            ]);
    }

    public function testInfoHargaBahanWithoutTanggalDefaultsToToday()
    {
        $bahan = Bahan::first();
        $today = Carbon::today()->format('Y-m-d');

        $response = $this->getJson("/api/info-harga/bahan?bahan_id={$bahan->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'tanggal' => $today,
            ]);
    }

    public function testInfoHargaBahanValidationMissingBahanId()
    {
        $response = $this->getJson('/api/info-harga/bahan');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['bahan_id']);
    }

    public function testInfoHargaBahanValidationInvalidBahanId()
    {
        $response = $this->getJson('/api/info-harga/bahan?bahan_id=999999');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['bahan_id']);
    }

    public function testInfoHargaBahanValidationInvalidTanggal()
    {
        $bahan = Bahan::first();

        $response = $this->getJson("/api/info-harga/bahan?bahan_id={$bahan->id}&tanggal=invalid-date");

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['tanggal']);
    }
}
