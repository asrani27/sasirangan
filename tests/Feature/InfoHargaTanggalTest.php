<?php

namespace Tests\Feature;

use App\Bahan;
use App\Pasar;
use Tests\TestCase;

class InfoHargaTanggalTest extends TestCase
{
    public function testInfoHargaTanggalWithValidFilter()
    {
        $pasar = Pasar::first();
        $bahan = Bahan::first();

        $response = $this->getJson("/api/info-harga/tanggal?pasar_id={$pasar->id}&bahan_id={$bahan->id}&tanggal_mulai=2021-04-01&tanggal_berakhir=2021-04-20");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Harga Berdasarkan Tanggal Ditemukan',
                'pasar' => [
                    'id' => $pasar->id,
                    'nama' => $pasar->nama,
                ],
                'bahan' => [
                    'id' => $bahan->id,
                    'nama' => $bahan->nama,
                ],
                'tanggal_mulai' => '2021-04-01',
                'tanggal_berakhir' => '2021-04-20',
                'total_data' => 20,
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'pasar' => ['id', 'nama'],
                'bahan' => ['id', 'nama', 'satuan'],
                'tanggal_mulai',
                'tanggal_berakhir',
                'total_data',
                'data' => [
                    '*' => [
                        'tanggal',
                        'harga',
                        'formatted',
                    ]
                ]
            ]);

        $data = $response->json('data');
        $this->assertCount(20, $data);
        $this->assertEquals('2021-04-01', $data[0]['tanggal']);
        $this->assertEquals('2021-04-20', $data[19]['tanggal']);
    }

    public function testInfoHargaTanggalViaBaseInfoHargaEndpoint()
    {
        $pasar = Pasar::first();
        $bahan = Bahan::first();

        $response = $this->getJson("/api/info-harga?pasar_id={$pasar->id}&bahan_id={$bahan->id}&tanggal_mulai=2021-04-01&tanggal_berakhir=2021-04-20");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Harga Berdasarkan Tanggal Ditemukan',
                'pasar' => [
                    'id' => $pasar->id,
                    'nama' => $pasar->nama,
                ],
                'bahan' => [
                    'id' => $bahan->id,
                    'nama' => $bahan->nama,
                ],
                'total_data' => 20,
            ]);

        $this->assertCount(20, $response->json('data'));
    }

    public function testInfoHargaTanggalViaPeriodeEndpoint()
    {
        $pasar = Pasar::first();
        $bahan = Bahan::first();

        $response = $this->getJson("/api/info-harga/periode?pasar_id={$pasar->id}&bahan_id={$bahan->id}&tanggal_mulai=2021-04-01&tanggal_berakhir=2021-04-20");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'total_data' => 20,
            ]);
    }

    public function testInfoHargaTanggalValidationMissingParams()
    {
        $response = $this->getJson('/api/info-harga/tanggal');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['pasar_id', 'bahan_id', 'tanggal_mulai', 'tanggal_berakhir']);
    }

    public function testInfoHargaTanggalValidationInvalidPasar()
    {
        $bahan = Bahan::first();

        $response = $this->getJson("/api/info-harga/tanggal?pasar_id=999999&bahan_id={$bahan->id}&tanggal_mulai=2021-04-01&tanggal_berakhir=2021-04-20");

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['pasar_id']);
    }

    public function testInfoHargaTanggalValidationInvalidBahan()
    {
        $pasar = Pasar::first();

        $response = $this->getJson("/api/info-harga/tanggal?pasar_id={$pasar->id}&bahan_id=999999&tanggal_mulai=2021-04-01&tanggal_berakhir=2021-04-20");

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['bahan_id']);
    }

    public function testInfoHargaTanggalValidationInvalidDateOrder()
    {
        $pasar = Pasar::first();
        $bahan = Bahan::first();

        $response = $this->getJson("/api/info-harga/tanggal?pasar_id={$pasar->id}&bahan_id={$bahan->id}&tanggal_mulai=2021-04-20&tanggal_berakhir=2021-04-01");

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['tanggal_berakhir']);
    }

    public function testInfoHargaTanggalValidationInvalidDateFormat()
    {
        $pasar = Pasar::first();
        $bahan = Bahan::first();

        $response = $this->getJson("/api/info-harga/tanggal?pasar_id={$pasar->id}&bahan_id={$bahan->id}&tanggal_mulai=invalid-date&tanggal_berakhir=2021-04-20");

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['tanggal_mulai']);
    }
}
