@extends('Pelanggan.Layout.index')

@section('content')
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@endsection