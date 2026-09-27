<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/*
 * Controller ini menangani semua operasi CRUD untuk transaksi kas kelas.
 * Endpoint API dipakai oleh Blade/JavaScript untuk mengisi data di halaman
 * riwayat, laporan, dan beranda tanpa reload halaman.
 */
class TransactionController extends Controller
{
    /*
     * index(): mengambil seluruh data transaksi dari database lalu menghitung saldo
     * total berdasarkan jenis transaksi (pemasukan atau pengeluaran).
     */
    public function index()
    {
        $transactions = Transaction::query()
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->get();

        $saldo = $transactions->reduce(fn ($total, $item) => $item->type === 'in' ? $total + $item->amount : $total - $item->amount, 0);

        return response()->json([
            'saldo' => $saldo,
            'transactions' => $transactions->map(function ($transaction) {
                return [
                    'id' => $transaction->id,
                    'desc' => $transaction->description,
                    'cat' => $transaction->category,
                    'date' => $transaction->transaction_date->translatedFormat('d M'),
                    'type' => $transaction->type,
                    'amount' => $transaction->amount,
                    'transaction_date' => $transaction->transaction_date->format('Y-m-d'),
                ];
            })->values(),
        ]);
    }

    /*
     * show(): mengambil satu transaksi spesifik.
     * Biasanya dipakai saat form edit ingin menampilkan data lama.
     */
    public function show(Transaction $transaction)
    {
        return response()->json([
            'data' => [
                'id' => $transaction->id,
                'desc' => $transaction->description,
                'cat' => $transaction->category,
                'date' => $transaction->transaction_date->translatedFormat('d M'),
                'type' => $transaction->type,
                'amount' => $transaction->amount,
                'transaction_date' => $transaction->transaction_date->format('Y-m-d'),
            ],
        ]);
    }

    /*
     * store(): validasi input lalu simpan transaksi baru ke database.
     * request validate ini mencegah data kosong, jumlah negatif, dan tipe invalid.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['in', 'out'])],
            'amount' => ['required', 'integer', 'min:1'],
            'transaction_date' => ['nullable', 'date'],
        ]);

        $transaction = Transaction::create([
            'description' => $validated['description'],
            'category' => $validated['category'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'transaction_date' => $validated['transaction_date'] ?? now()->toDateString(),
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil disimpan.',
            'data' => [
                'id' => $transaction->id,
                'desc' => $transaction->description,
                'cat' => $transaction->category,
                'date' => $transaction->transaction_date->translatedFormat('d M'),
                'type' => $transaction->type,
                'amount' => $transaction->amount,
                'transaction_date' => $transaction->transaction_date->format('Y-m-d'),
            ],
        ], 201);
    }

    /*
     * update(): memperbarui transaksi yang sudah ada.
     * Saat form edit dikirim, data lama diganti dengan data baru lalu disimpan.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['in', 'out'])],
            'amount' => ['required', 'integer', 'min:1'],
            'transaction_date' => ['nullable', 'date'],
        ]);

        $transaction->update([
            'description' => $validated['description'],
            'category' => $validated['category'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'transaction_date' => $validated['transaction_date'] ?? $transaction->transaction_date->toDateString(),
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil diperbarui.',
            'data' => $transaction,
        ]);
    }

    /*
     * destroy(): menghapus transaksi dari database.
     * Biasanya dipanggil saat user menekan tombol hapus di tabel laporan.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json([
            'message' => 'Transaksi berhasil dihapus.',
        ]);
    }
}
