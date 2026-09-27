<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggotas = [
            ['nama' => 'Ahmad Rizky', 'status' => 'paid'],
            ['nama' => 'Bella Safira', 'status' => 'paid'],
            ['nama' => 'Citra Wulandari', 'status' => 'unpaid'],
            ['nama' => 'Dimas Prasetyo', 'status' => 'paid'],
            ['nama' => 'Evan Saputra', 'status' => 'unpaid'],
            ['nama' => 'Farah Nabila', 'status' => 'paid'],
            ['nama' => 'Gilang Ramadhan', 'status' => 'paid'],
            ['nama' => 'Hana Puspita', 'status' => 'unpaid'],
        ];

        foreach ($anggotas as $anggota) {
            Anggota::query()->firstOrCreate([
                'nama' => $anggota['nama'],
            ], $anggota);
        }
    }
}
