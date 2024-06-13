@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('barang_masuks.create') }}" class="btn btn-md btn-success mb-3">ADD BARANG MASUK</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">TANGGAL MASUK</th>
                                    <th scope="col">QUANTITY MASUK</th>
                                    <th scope="col">BARANG</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barangmasuks as $barangmasuk)
                                    <tr>
                                        <td>{{ $barangmasuk->id }}</td>
                                        <td>{{ $barangmasuk->tgl_masuk }}</td>
                                        <td>{{ $barangmasuk->qty_masuk }}</td>
                                        <td>{{ $barangmasuk->barang->merk }} - {{ $barangmasuk->barang->seri }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang_masuks.destroy', $barangmasuk->id) }}" method="POST">
                                                <a href="{{ route('barang_masuks.show', $barangmasuk->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('barang_masuks.edit', $barangmasuk->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Barang masuk belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $barangmasuks->links() }}
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
