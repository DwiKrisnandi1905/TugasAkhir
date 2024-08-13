@extends('admin.layout.index')

@section('content')
<style>
    .pesanan-card {
        padding: 9px 15px 9px 7px;
        background: var(--success-100, #ECFDF3);
        cursor: pointer;
    }
    .read-pesanan {
        cursor: pointer;
    }
    .pesan-card {
        padding: 9px 15px 9px 7px;
        background: var(--success-100, #ECFDF3);
        cursor: pointer;
    }
    .read-pesan {
        cursor: pointer;
    }
</style>
<div class="card mb-3" id="Notifikasi">
  <div class="card-body">
    <div class="d-flex justify-content-spacebetween mb-3">
      <h5 class="fw-bold">Pesanan Masuk</h5>
      <p class="read-pesanan ms-auto">Tandai sudah dibaca</p>
    </div>
    <div class="card pesanan-card d-flex mb-3">
      <div class="card-body d-flex flex-column">
      </div>
    </div>
    <div class="card pesanan-card d-flex mb-3">
      <div class="card-body d-flex flex-column">
      </div>
    </div>
  </div>
</div>
<div class="card" id="Notifikasi">
  <div class="card-body">
    <div class="d-flex justify-content-spacebetween mb-3">
      <h5 class="fw-bold">Pesan Masuk</h5>
      <p class="read-pesan ms-auto">Tandai sudah dibaca</p>
    </div>
    <div class="card pesan-card d-flex mb-3">
      <div class="card-body d-flex flex-column">
      </div>
    </div>
    <div class="card pesan-card d-flex mb-3">
      <div class="card-body d-flex flex-column">
      </div>
    </div>
  </div>
</div>
@endsection
