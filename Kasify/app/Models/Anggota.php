<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * Model Anggota digunakan untuk data anggota kelas.
 * Nama tabelnya ditulis secara eksplisit karena default Eloquent akan
 * menebak tabel 'anggotas' sesuai dengan nama model, jadi ini tetap aman
 * dan mudah dipahami saat tim membaca kode.
 */
class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';

    /*
     * Kolom yang diizinkan untuk diisi saat menambah atau mengubah anggota.
     */
    protected $fillable = [
        'nama',
        'status',
    ];
}
