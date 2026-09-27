<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/*
 * Controller ini mengelola data anggota kelas seperti nama dan status iuran.
 * Data ini dipakai oleh halaman Anggota untuk menampilkan daftar dan
 * melakukan aksi tambah, edit, toggle, serta hapus.
 */
class AnggotaController extends Controller
{
    /*
     * index(): mengambil semua anggota dari database lalu mengurutkannya berdasarkan nama.
     * Response JSON ini nantinya digunakan oleh frontend JavaScript untuk render tabel.
     */
    public function index()
    {
        $anggotas = Anggota::query()->orderBy('nama')->get();

        return response()->json([
            'data' => $anggotas->map(fn ($anggota) => [
                'id' => $anggota->id,
                'nama' => $anggota->nama,
                'status' => $anggota->status,
            ])->values(),
        ]);
    }

    /*
     * show(): menampilkan satu data anggota berdasarkan id.
     */
    public function show(Anggota $anggota)
    {
        return response()->json([
            'data' => [
                'id' => $anggota->id,
                'nama' => $anggota->nama,
                'status' => $anggota->status,
            ],
        ]);
    }

    /*
     * store(): validasi input lalu simpan anggota baru.
     * status dibatasi hanya 'paid' atau 'unpaid'.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['paid', 'unpaid'])],
        ]);

        $anggota = Anggota::create([
            'nama' => $validated['nama'],
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'Anggota berhasil ditambahkan.',
            'data' => [
                'id' => $anggota->id,
                'nama' => $anggota->nama,
                'status' => $anggota->status,
            ],
        ], 201);
    }

    /*
     * update(): mengubah data anggota yang sudah ada.
     * Dapat dipakai saat user menyunting nama atau status pembayaran.
     */
    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['paid', 'unpaid'])],
        ]);

        $anggota->update([
            'nama' => $validated['nama'],
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'Anggota berhasil diperbarui.',
            'data' => [
                'id' => $anggota->id,
                'nama' => $anggota->nama,
                'status' => $anggota->status,
            ],
        ]);
    }

    /*
     * destroy(): menghapus data anggota dari database.
     */
    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return response()->json([
            'message' => 'Anggota berhasil dihapus.',
        ]);
    }
}
