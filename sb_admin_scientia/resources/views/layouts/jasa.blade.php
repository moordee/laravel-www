@extends('partials.master')

@section('title', 'Jasa')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Jasa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Jasa</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Jasa
                    <a class="btn btn-sm btn-primary float-end" href="/tambah_jasa">Tambah Jasa</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama Jasa</th>
                                <th>Harga Satuan (Rp/kg)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No. </th>
                                <th>Nama Jasa</th>
                                <th>Harga Satuan (Rp/kg)</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>10/08/2026</td>
                                <td>Cuci Kering</td>
                                <td>6.000</td>
                                <td><a href="/jasa" class="btn btn-sm btn-warning">Ubah</a> <a href="/jasa"
                                        class="btn btn-sm btn-danger">Hapus</a></td>
                            </tr>
                            <tr>
                                <td>10/08/2026</td>
                                <td>Cuci Setrika</td>
                                <td>7.000</td>
                                <td><a href="/jasa" class="btn btn-sm btn-warning">Ubah</a> <a href="/jasa"
                                        class="btn btn-sm btn-danger">Hapus</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
