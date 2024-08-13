@extends('admin.layout.index')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="mb-3 text-primary" onclick="window.location='{{ route('metodeTransaksi') }}';">
            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('updateMetode', $metode->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_bank" class="form-label">Nama Bank:</label>
                <input type="text" class="form-control" id="nama_bank" name="nama_bank" value="{{ $metode->nama_bank }}" placeholder="Contoh: BNI">
            </div>
            <div class="mb-3">
                <label for="no_rekening" class="form-label">No Rekening:</label>
                <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="{{ $metode->no_rekening }}" placeholder="Contoh: 1234567890">
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
