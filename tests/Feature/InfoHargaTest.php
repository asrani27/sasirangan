<?php

namespace Tests\Feature;

use Tests\TestCase;

class InfoHargaTest extends TestCase
{
    public function testInfoHargaWithPasarId()
    {
        $response = $this->getJson('/api/info-harga?pasar_id=1&tanggal=2023-05-30');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Harga Ditemukan',
                'pasar' => [
                    'id' => 1,
                ],
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'pasar' => ['id', 'nama'],
                'tanggal',
                'tanggal_kemarin',
                'total_data',
                'data' => [
                    '*' => [
                        'bahan_pokok',
                        'satuan',
                        'harga_kemarin',
                        'harga_terkini',
                        'perubahan',
                        'perubahan_persen',
                    ]
                ]
            ]);
    }

    public function testInfoHargaWithoutPasarIdShowsAllPasar()
    {
        $response = $this->getJson('/api/info-harga?tanggal=2023-05-30');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Harga Semua Pasar Ditemukan',
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'tanggal',
                'tanggal_kemarin',
                'total_pasar',
                'data' => [
                    '*' => [
                        'pasar' => ['id', 'nama'],
                        'total_data',
                        'data'
                    ]
                ]
            ]);
    }

    public function testInfoHargaWithoutParametersDefaultsToToday()
    {
        $response = $this->getJson('/api/info-harga');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Harga Semua Pasar Ditemukan',
            ]);
    }

    public function testInfoHargaInvalidPasarIdReturnsValidationError()
    {
        $response = $this->getJson('/api/info-harga?pasar_id=999999');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['pasar_id']);
    }

    public function testInfoHargaInvalidTanggalReturnsValidationError()
    {
        $response = $this->getJson('/api/info-harga?tanggal=invalid-date');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['tanggal']);
    }

    public function testListPasarReturnsPasarWithBahan()
    {
        $response = $this->getJson('/api/info-harga/pasar');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Pasar Ditemukan',
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'nama',
                        'bahan' => [
                            '*' => [
                                'id',
                                'nama',
                            ],
                        ],
                    ],
                ],
            ]);

        // Verifikasi bahwa field pada bahan hanya 'id' dan 'nama'
        $firstPasar = $response->json('data.0');
        if (!empty($firstPasar['bahan'])) {
            $firstBahanKeys = array_keys($firstPasar['bahan'][0]);
            sort($firstBahanKeys);
            $this->assertEquals(['id', 'nama'], $firstBahanKeys);
        }
    }

    public function testListPasarFilterWithValidPasarId()
    {
        $response = $this->getJson('/api/info-harga/pasar?pasar_id=1');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Pasar Ditemukan',
                'data' => [
                    'id' => 1,
                ],
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'nama',
                    'bahan' => [
                        '*' => [
                            'id',
                            'nama',
                        ],
                    ],
                ],
            ]);

        // Verifikasi bahwa field pada bahan hanya 'id' dan 'nama'
        $bahan = $response->json('data.bahan');
        if (!empty($bahan)) {
            $firstBahanKeys = array_keys($bahan[0]);
            sort($firstBahanKeys);
            $this->assertEquals(['id', 'nama'], $firstBahanKeys);
        }
    }

    public function testListPasarFilterWithInvalidPasarIdReturnsNotFound()
    {
        $response = $this->getJson('/api/info-harga/pasar?pasar_id=999999');

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'Data Pasar Tidak Ditemukan',
                'data' => null,
            ]);
    }
}
