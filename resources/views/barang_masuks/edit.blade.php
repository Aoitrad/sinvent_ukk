@extends('layouts.main')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('barang_masuks.update', $barangmasuk->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL MASUK</label>
                                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ old('tgl_masuk', $barangmasuk->tgl_masuk) }}" placeholder="Masukkan Tanggal Masuk">
                                @error('tgl_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">QUANTITY MASUK</label>
                                <input type="number" class="form-control @error('qty_masuk') is-invalid @enderror" name="qty_masuk" value="{{ old('qty_masuk', $barangmasuk->qty_masuk) }}" placeholder="Masukkan Quantity masuk">
                                @error('qty_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">BARANG</label>
                                <select name="barang_id" class="form-control @error('barang_id') is-invalid @enderror">
                                    <option value="">Pilih Barang</option>
                                    @foreach($barangs as $barang)
                                        <option value="{{ $barang->id }}" {{ $barang->id == $barangmasuk->barang_id ? 'selected' : '' }}>
                                            {{ $barang->merk }} - {{ $barang->seri }} (Stok Tersedia: {{ $barang->stok }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <a href="{{ route('barang_masuks.index') }}" class="btn btn-md btn-secondary">BACK</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
