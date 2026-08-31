@extends('partials.master')

@section('title', 'Beranda')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Beranda</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Beranda</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">3</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">Jasa</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">10</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">Transaksi</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            3
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">Belum Bayar</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Rp. 1.000.000</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">Pendapatan Hari Ini</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Transaksi Terbaru
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Jasa</th>
                                <th>Banyaknya (kg)</th>
                                <th>Harga Satuan</th>
                                <th>Total Pembayaran</th>
                                <th>Status Pembayaran</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Jasa</th>
                                <th>Banyaknya (kg)</th>
                                <th>Harga Satuan</th>
                                <th>Total Pembayaran</th>
                                <th>Status Pembayaran</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>10/08/2026</td>
                                <td>Cuci Kering</td>
                                <td>5</td>
                                <td>6.000</td>
                                <td>30.000</td>
                                <td>Lunas</td>
                            </tr>
                            <tr>
                                <td>10/08/2026</td>
                                <td>Cuci Setrika</td>
                                <td>3</td>
                                <td>7.000</td>
                                <td>21.000</td>
                                <td>Belum Bayar</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
