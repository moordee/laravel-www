<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            [
                'description' => 'Iuran mingguan',
                'category' => 'Iuran anggota',
                'type' => 'in',
                'amount' => 90000,
                'transaction_date' => '2026-09-03',
            ],
            [
                'description' => 'Beli spidol & penghapus',
                'category' => 'Perlengkapan kelas',
                'type' => 'out',
                'amount' => 35000,
                'transaction_date' => '2026-09-01',
            ],
            [
                'description' => 'Iuran mingguan',
                'category' => 'Iuran anggota',
                'type' => 'in',
                'amount' => 120000,
                'transaction_date' => '2026-08-28',
            ],
            [
                'description' => 'Sumbangan acara 17-an',
                'category' => 'Kas keluar',
                'type' => 'out',
                'amount' => 60000,
                'transaction_date' => '2026-08-20',
            ],
        ];

        foreach ($transactions as $transaction) {
            Transaction::query()->firstOrCreate($transaction);
        }
    }
}
