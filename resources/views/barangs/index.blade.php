@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                       
                        <a href="{{ route('barangs.create') }}" class="btn btn-md btn-success mb-3">ADD BARANG</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">MERK</th>
                                    <th scope="col">SERI</th>
                                    <th scope="col">SPESIFIKASI</th>
                                    <th scope="col">STOK</th>
                                    <th scope="col">KATEGORI</th>
                                    <th scope="col">DESKRIPSI KATEGORI</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barangs as $barang)
                                    <tr>
                                        <td>{{ $barang->id }}</td>
                                        <td>{{ $barang->merk }}</td>
                                        <td>{{ $barang->seri }}</td>
                                        <td>{{ $barang->spesifikasi }}</td>
                                        <td>{{ $barang->stok }}</td>
                                        <td>{{ $barang->kategori->kategori }}</td>
                                        <td>{{ $barang->kategori->deskripsi }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangs.destroy', $barang->id) }}" method="POST">
                                                <a href="{{ route('barangs.show', $barang->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Barang belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $barangs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endsection
