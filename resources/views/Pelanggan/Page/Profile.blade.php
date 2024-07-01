@extends('Pelanggan.Layout.index')

@section('content')
<div class="container rounded bg-white mt-5">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" src="images/profil.png" width="90">
                <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                <span class="text-black-50">{{ Auth::user()->email }}</span>
            </div>
        </div>
        <div class="col-md-8">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold">Profile Anda</h3>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><input class="form-control" placeholder="Nama Depan" value="{{ Auth::user()->name }}" readonly></div>
                    <div class="col-md-6"><input class="form-control" value="Doe" placeholder="Nama Belakang" readonly></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><input class="form-control" placeholder="Email" value="john_doe12@bbb.com" readonly></div>
                    <div class="col-md-6"><input class="form-control" value="" placeholder="No. Telepon" readonly></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><input class="form-control" placeholder="Alamat" value="" readonly></div>
                    <div class="col-md-6"><input class="form-control" value="" placeholder="Negara" readonly></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><input class="form-control" placeholder="Bank yang Digunakan" value="" readonly></div>
                    <div class="col-md-6"><input class="form-control" value="" placeholder="No. Akun" readonly></div>
                </div>
                <div class="mt-5 text-right">
                    <a href="{{ route('statusPesanan') }}" class="btn btn-danger">Status Pesanan</a>
                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                </div>
                <div class="mt-3 text-right">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="text-start fw-bold">First Name</label>
                    <input type="text" class="form-control" id="modalFirstName" value="John">
                </div>
                <div class="form-group">
                    <label class="text-start fw-bold">Last Name</label>
                    <input type="text" class="form-control" id="modalLastName" value="Doe">
                </div>
                <div class="form-group">
                    <label class="text-start fw-bold" >Email</label>
                    <input type="email" class="form-control" id="modalEmail" value="john_doe12@bbb.com">
                </div>
                <div class="form-group">
                    <label class="text-start fw-bold">Phone Number</label>
                    <input type="text" class="form-control" id="modalPhone" value="+19685969668">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
