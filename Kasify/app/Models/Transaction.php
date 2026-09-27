<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * Model Transaction berperan sebagai representasi tabel transactions.
 * Model ini memungkinkan Laravel untuk melakukan query, create, update,
 * dan delete data transaksi tanpa menulis SQL manual.
 */
class Transaction extends Model
{
    use HasFactory;

    /*
     * fillable menentukan kolom yang boleh diisi saat create/update.
     * ini penting agar mass assignment aman dan konsisten.
     */
    protected $fillable = [
        'description',
        'category',
        'type',
        'amount',
        'transaction_date',
    ];

    /*
     * casts memastikan nilai amount selalu bertipe integer,
     * sedangkan transaction_date otomatis diubah ke objek Carbon date.
     */
    protected $casts = [
        'amount' => 'integer',
        'transaction_date' => 'date:Y-m-d',
    ];
}
