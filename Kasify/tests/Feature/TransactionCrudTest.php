<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaction_api_supports_crud_flow(): void
    {
        $this->seed();

        $indexResponse = $this->getJson('/api/transaksi');
        $indexResponse->assertOk();
        $indexResponse->assertJsonStructure([
            'saldo',
            'transactions' => [
                '*' => ['id', 'desc', 'cat', 'date', 'type', 'amount', 'transaction_date'],
            ],
        ]);

        $createResponse = $this->postJson('/api/transaksi', [
            'description' => 'Iuran tambahan',
            'category' => 'Sumbangan acara',
            'type' => 'in',
            'amount' => 250000,
            'transaction_date' => '2026-09-20',
        ]);

        $createResponse->assertStatus(201);
        $createResponse->assertJsonPath('data.desc', 'Iuran tambahan');

        $transactionId = $createResponse->json('data.id');

        $updateResponse = $this->putJson('/api/transaksi/' . $transactionId, [
            'description' => 'Iuran tambahan revisi',
            'category' => 'Sumbangan acara',
            'type' => 'in',
            'amount' => 300000,
            'transaction_date' => '2026-09-21',
        ]);

        $updateResponse->assertOk();
        $updateResponse->assertJsonPath('data.desc', 'Iuran tambahan revisi');
        $updateResponse->assertJsonPath('data.cat', 'Sumbangan acara');
        $updateResponse->assertJsonPath('data.transaction_date', '2026-09-21');

        $deleteResponse = $this->deleteJson('/api/transaksi/' . $transactionId);
        $deleteResponse->assertOk();
        $deleteResponse->assertJsonPath('message', 'Transaksi berhasil dihapus.');
    }
}
