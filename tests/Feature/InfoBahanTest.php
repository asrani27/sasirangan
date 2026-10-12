<?php

namespace Tests\Feature;

use App\Bahan;
use Tests\TestCase;

class InfoBahanTest extends TestCase
{
    public function testInfoBahanReturnsAllBahanWithOnlyIdAndNama()
    {
        $response = $this->getJson('/api/info-bahan');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Bahan Ditemukan',
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'total_data',
                'data' => [
                    '*' => [
                        'id',
                        'nama',
                    ],
                ],
            ]);

        $data = $response->json('data');
        $this->assertNotEmpty($data);

        // Verify that only 'id' and 'nama' fields are present
        foreach ($data as $item) {
            $this->assertEquals(['id', 'nama'], array_keys($item));
        }
    }

    public function testInfoBahanViaBahanEndpointAlias()
    {
        $response = $this->getJson('/api/bahan');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Bahan Ditemukan',
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'total_data',
                'data' => [
                    '*' => [
                        'id',
                        'nama',
                    ],
                ],
            ]);

        $data = $response->json('data');
        $this->assertNotEmpty($data);

        foreach ($data as $item) {
            $this->assertEquals(['id', 'nama'], array_keys($item));
        }
    }

    public function testInfoBahanFilterWithValidId()
    {
        $bahan = Bahan::first();
        $this->assertNotNull($bahan);

        $response = $this->getJson('/api/info-bahan?id=' . $bahan->id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Bahan Ditemukan',
                'data' => [
                    'id' => $bahan->id,
                    'nama' => $bahan->nama,
                ],
            ]);

        $item = $response->json('data');
        $this->assertEquals(['id', 'nama'], array_keys($item));
    }

    public function testInfoBahanFilterWithValidBahanIdParam()
    {
        $bahan = Bahan::first();
        $this->assertNotNull($bahan);

        $response = $this->getJson('/api/info-bahan?bahan_id=' . $bahan->id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Data Bahan Ditemukan',
                'data' => [
                    'id' => $bahan->id,
                    'nama' => $bahan->nama,
                ],
            ]);

        $item = $response->json('data');
        $this->assertEquals(['id', 'nama'], array_keys($item));
    }

    public function testInfoBahanFilterWithInvalidIdReturnsNotFound()
    {
        $response = $this->getJson('/api/info-bahan?id=999999');

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'Data Bahan Tidak Ditemukan',
                'data' => null,
            ]);
    }
}
