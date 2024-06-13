@extends('layouts.main')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h1>Detail Barang</h1>
                        <p><strong>Merk:</strong> {{ $barang->merk }}</p>
                        <p><strong>Seri:</strong> {{ $barang->seri }}</p>
                        <p><strong>Spesifikasi:</strong> {{ $barang->spesifikasi }}</p>
                        <p><strong>Stok:</strong> {{ $barang->stok }}</p>
                        <p><strong>Kategori:</strong> {{ $barang->kategori->kategori }}</p>
                        <p><strong>Deskripsi Kategori:</strong> {{ $barang->kategori->deskripsi }}</p>
                        <a href="{{ route('barangs.index') }}" class="btn btn-md btn-secondary">BACK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
