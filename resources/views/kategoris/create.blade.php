@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('kategoris.store') }}" method="POST">                    
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">KATEGORI</label>
                                <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="M">Modal (M)</option>
                                    <option value="A">Alat (A)</option>
                                    <option value="BHP">Bahan Habis Pakai (BHP)</option>
                                    <option value="BTHP">Bahan Tidak Habis Pakai (BTHP)</option>
                                </select>
                                
                                <!-- error message untuk kategori -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">DESKRIPSI</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Masukkan Deskripsi Kategori">
                            
                                <!-- error message untuk deskripsi -->
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{ route('kategoris.index') }}" class="btn btn-md btn-secondary">BACK</a>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
