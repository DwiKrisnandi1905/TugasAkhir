@extends('Pelanggan.Layout.index')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4 text-center">Masukkan Alamat Pengiriman</h2>
    <form action="{{ route('alamatKonveksi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_pemilik_rumah">Konfirmasi Nama Pembeli</label>
            <input type="text" class="form-control" id="nama_pemilik_rumah" name="nama_pemilik_rumah" required>
        </div>
        <div class="form-group">
            <label for="alamat_lengkap">Alamat Lengkap</label>
            <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" required></textarea>
        </div>
        <div class="form-group">
            <label for="kode_pos">Kode Pos</label>
            <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
        </div>
        <div class="form-group">
            <label for="link_lokasi">Link Lokasi (Google Map)</label>
            <input type="text" class="form-control" id="link_lokasi" name="link_lokasi" required>
        </div>
        <button type="button" id="cancel-btn" class="btn btn-danger mt-2">batal</button>
        <button type="submit" class="btn btn-primary mt-2">Simpan Alamat</button>
    </form>
</div>
<script>
    document.getElementById('cancel-btn').addEventListener('click', function() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pesanan Anda akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff6f00',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('pesananKonveksi.cancel') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "{{ route('cartKonveksi') }}";
                    } else {
                        Swal.fire('Error', 'Terjadi kesalahan saat menghapus pesanan.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Terjadi kesalahan saat menghapus pesanan.', 'error');
                });
            }
        });
    });
</script>
@endsection
