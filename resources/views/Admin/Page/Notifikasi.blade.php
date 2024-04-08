@extends('Admin.Layout.index')

@section('content')
<style>
    .notification-card {
        padding: 9px 15px 9px 7px;
        background: var(--success-100, #ECFDF3);
        cursor: pointer;
    }
    .read-status {
        cursor: pointer;
    }
</style>
<div class="card" id="Notifikasi">
  <div class="card-body">
    <div class="read-status d-flex justify-content-end mb-3">Tandai sudah dibaca</div>
    <div class="card notification-card d-flex">
      <div class="card-body d-flex flex-column">
      </div>
    </div>
  </div>
</div>
@endsection
