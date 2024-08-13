@extends('admin.layout.index')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="mb-3 text-primary" onclick="window.location='{{ route('transaksi') }}';">
            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tambahMetode') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_bank" class="form-label">Nama Bank:</label>
                <input type="text" class="form-control" id="nama_bank" name="nama_bank" placeholder="Contoh: BNI">
            </div>
            <div class="mb-3">
                <label for="no_rekening" class="form-label">No Rekening:</label>
                <input type="text" class="form-control" id="no_rekening" name="no_rekening" placeholder="Contoh: 1234567890">
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>

        <h4 class="fw-bold">Daftar Kategori</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-4">Nama Bank</th>
                    <th scope="col" class="col-4">No Rekening</th>
                    <th scope="col" class="col-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($metode_transaksi as $metode)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $metode->nama_bank }}</td>
                        <td>{{ $metode->no_rekening }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('editMetode', $metode->id) }}" class="text-warning me-2">
                                    <i class="bi bi-pencil-square" style="font-size: 20px; cursor: pointer;"></i>
                                </a>
                                <form action="{{ route('deleteMetode', $metode->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <i class="bi bi-trash-fill text-danger" style="font-size: 20px; cursor: pointer;" onclick="confirmDelete(event)"></i>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan bisa mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endsection
