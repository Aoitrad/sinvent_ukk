@extends('layouts.main')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>Data Barang Keluar</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>TANGGAL KELUAR:</strong> {{ $barangkeluar->tgl_keluar }}</p>
                                <p><strong>QUANTITY KELUAR:</strong> {{ $barangkeluar->qty_keluar }}</p>
                                <p><strong>BARANG:</strong> {{ $barangkeluar->barang->merk }} - {{ $barangkeluar->barang->seri }}</p>
                                <p><strong>STOK SAAT INI:</strong> {{ $barangkeluar->barang->stok }}</p>
                            </div>
                        </div>
                        <hr>
                        <a href="{{ route('barang_keluars.index') }}" class="btn btn-md btn-secondary">BACK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
