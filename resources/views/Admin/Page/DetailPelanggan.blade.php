@extends('admin.layout.index')

@section('content')
<style>
    .btn.disabled,
    .btn[aria-disabled=true] {
        opacity: 0.6; 
        pointer-events: none; 
        background-color: #ccc;
    }
</style>
<div class="card" id="detailPelanggan">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div class="text-primary" onclick="window.location='{{ route('pelanggan') }}';">
                <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row" class="col-4">Id Pelanggan</th>
                    <td id="idPelanggan">{{ $user->id }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-4">Nama</th>
                    <td id="namaPelanggan">{{ $user->name }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-4">Email</th>
                    <td id="emailPelanggan">{{ $user->email }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-4">Gender</th>
                    <td id="genderPelanggan">{{ $user->gender }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-4">Tanggal Lahir</th>
                    <td id="birthdatePelanggan">{{ $user->birthdate }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-4">No. Telepon</th>
                    <td id="phonePelanggan">{{ $user->phone }}</td>
                </tr>
            </tbody>
        </table>  
    </div>    
</div>
@endsection
