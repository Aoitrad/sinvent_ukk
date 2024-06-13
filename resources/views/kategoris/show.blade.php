@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h4>ID: {{ $kategori->id }}</h4>
                        <h4>Kategori: {{ $kategori->kategori }} - {{ $kategori->kategori_description }}</h4>
                        <h4>Deskripsi: {{ $kategori->deskripsi }}</h4>
                        <a href="{{ route('kategoris.index') }}" class="btn btn-md btn-secondary">BACK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
