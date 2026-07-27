<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Siswa;


class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = DB::table('tb_siswa')->get();
        return view('biodata', ['siswa' => $siswa]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {
        Siswa::create([
            'nama_siswa' => $request->nama_siswa,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return back()->with('berhasil', 'Data siswa berhasil ditambahkan!');
    }

    public function tambah()
    {
        return view('tambah_biodata2');
    }

    /**
     * Store a newly created resource in storage.

     *public function store(Request $request)
     *{
     *    //
     *}
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function detail()
    {
        return view('detail');
    }
    public function detail1()
    {
        return view('detail1');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Siswa::where('id_siswa', $id)->first();

        return view('edit_biodata', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->update([
            'nama_siswa' => $request->nama_siswa,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return back()->with('berhasil', 'Data siswa berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Siswa::destroy($id);
        return back()->with('berhasil.', 'Data yang anda pilih telah berhasil dihapus.');
    }
}
