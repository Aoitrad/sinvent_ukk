@extends('layouts.main')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('kategoris.update', $kategori->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">DESKRIPSI</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi', $kategori->deskripsi) }}" placeholder="Masukkan Deskripsi Kategori">
                            
                                <!-- error message untuk deskripsi -->
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">KATEGORI</label>
                                <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="M" {{ $kategori->kategori == 'M' ? 'selected' : '' }}>Modal (M)</option>
                                    <option value="A" {{ $kategori->kategori == 'A' ? 'selected' : '' }}>Alat (A)</option>
                                    <option value="BHP" {{ $kategori->kategori == 'BHP' ? 'selected' : '' }}>Bahan Habis Pakai (BHP)</option>
                                    <option value="BTHP" {{ $kategori->kategori == 'BTHP' ? 'selected' : '' }}>Bahan Tidak Habis Pakai (BTHP)</option>
                                </select>
                                
                                <!-- error message untuk kategori -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{ route('kategoris.index') }}" class="btn btn-md btn-secondary">BACK</a>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@endsection
