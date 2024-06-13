@extends('layouts.main')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>Data Barang Masuk</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>TANGGAL MASUK:</strong> {{ $barangmasuk->tgl_masuk }}</p>
                                <p><strong>QUANTITY MASUK:</strong> {{ $barangmasuk->qty_masuk }}</p>
                                <p><strong>BARANG:</strong> {{ $barangmasuk->barang->merk }} - {{ $barangmasuk->barang->seri }}</p>
                                <p><strong>STOK SAAT INI:</strong> {{ $barangmasuk->barang->stok }}</p>
                            </div>
                        </div>
                        <hr>
                        <a href="{{ route('barang_masuks.index') }}" class="btn btn-md btn-secondary">BACK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
