@extends('Pelanggan.Layout.index')

@section('content')
<style>
    .bg-light-orange {
        background-color: #f5f5f5;
    }
    .form-control {
        width: 100%;
        border: 3px solid #e74900;
    }
    @media (min-width: 768px) {
    }
</style>
<div class="container bg-light-orange mt-5 p-4 rounded profile-container mx-auto">
    <div class="text-center p-3">
        <img class="rounded-circle mt-3" src="images/profil.png" width="120">
        <h4 class="font-weight-bold mt-3">{{ Auth::user()->name }}</h4>
        <p class="text-black">{{ Auth::user()->email }}</p>
    </div>
    <div class="p-3">
        <h3 class="fw-bold mb-4 text-center">Profile Anda</h3>
        <div class="form-group mb-3">
            <label>Nama Lengkap</label>
            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
        </div>
        <div class="form-group mb-3">
            <label>Jenis Kelamin</label>
            <input type="text" class="form-control" value="{{ Auth::user()->gender }}" readonly>
        </div>
        <div class="form-group mb-3">
            <label>Tanggal Lahir</label>
            <input type="text" class="form-control" value="{{ Auth::user()->birthdate }}" readonly>
        </div>
        <div class="form-group mb-4">
            <label>No. Telepon</label>
            <input type="text" class="form-control" value="{{ Auth::user()->phone }}" readonly>
        </div>
        <div class="text-center">
            <a href="{{ route('statusPesanan') }}" class="btn btn-danger mr-2 mb-2 loading">Status Pesanan</a>
            <button class="btn btn-danger mr-2 mb-2" type="button" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger mb-2">Logout</button>
            </form>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm" action="{{ route('updateProfile') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="text-start fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="modalFullName" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label class="text-start fw-bold">Email</label>
                        <input type="email" class="form-control" id="modalEmail" value="{{ Auth::user()->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label class="text-start fw-bold">Jenis Kelamin</label>
                        <select class="form-control" name="gender" id="modalGender">
                            <option value="Laki-laki" {{ Auth::user()->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ Auth::user()->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-start fw-bold">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="birthdate" id="modalBirthdate" value="{{ Auth::user()->birthdate }}">
                    </div>
                    <div class="form-group">
                        <label class="text-start fw-bold">No. Telepon</label>
                        <input type="text" class="form-control" name="phone" id="modalPhone" value="{{ Auth::user()->phone }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger loading" onclick="submitEditProfileForm()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function submitEditProfileForm() {
        document.getElementById('editProfileForm').submit();
    }
</script>
@endsection
