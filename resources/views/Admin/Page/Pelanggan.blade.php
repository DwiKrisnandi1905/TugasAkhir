@extends('Admin.Layout.index')

@section('content')
<div class="card" id="Pelanggan">
  <div class="card-body">
    <div class="d-flex justify-content-between mb-3">
      <div class="d-flex align-items-center"> 
        <div class="dropdown" style="padding: 0 8px;">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Filters
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">A - Z</a></li>
          </ul>
        </div>
      </div>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-warning" type="submit">Search</button>
      </form>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col" class="col-4">Nama</th>
          <th scope="col" class="col-4">Alamat</th>
          <th scope="col" class="col-2">Telepon</th>
          <th scope="col" class="col-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>John Doe</td>
          <td>123 Main St, City</td>
          <td>123-456-7890</td>
          <td>
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-danger">Hapus</button>
          </td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jane Smith</td>
          <td>456 Elm St, Town</td>
          <td>987-654-3210</td>
          <td>
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-danger">Hapus</button>
          </td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Jane Smith</td>
          <td>456 Elm St, Town</td>
          <td>987-654-3210</td>
          <td>
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-danger">Hapus</button>
          </td>
        </tr>
        <tr>
          <th scope="row">4</th>
          <td>Jane Smith</td>
          <td>456 Elm St, Town</td>
          <td>987-654-3210</td>
          <td>
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-danger">Hapus</button>
          </td>
        </tr>
        <tr>
          <th scope="row">5</th>
          <td>Jane Smith</td>
          <td>456 Elm St, Town</td>
          <td>987-654-3210</td>
          <td>
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-danger">Hapus</button>
          </td>
        </tr>
        <tr>
          <th scope="row">6</th>
          <td>Jane Smith</td>
          <td>456 Elm St, Town</td>
          <td>987-654-3210</td>
          <td>
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-danger">Hapus</button>
          </td>
        </tr>
        <tr>
          <th scope="row">7</th>
          <td>Jane Smith</td>
          <td>456 Elm St, Town</td>
          <td>987-654-3210</td>
          <td>
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-danger">Hapus</button>
          </td>
        </tr>
        <tr>
          <th scope="row">8</th>
          <td>Jane Smith</td>
          <td>456 Elm St, Town</td>
          <td>987-654-3210</td>
          <td>
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-danger">Hapus</button>
          </td>
        </tr>
        <tr>
          <th scope="row">9</th>
          <td>Jane Smith</td>
          <td>456 Elm St, Town</td>
          <td>987-654-3210</td>
          <td>
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-danger">Hapus</button>
          </td>
        </tr>
        <tr>
          <th scope="row">10</th>
          <td>Jane Smith</td>
          <td>456 Elm St, Town</td>
          <td>987-654-3210</td>
          <td>
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-danger">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-between mb-3">
      <div class="d-flex align-items-center mb-5"> 
        <span>Tampilkan</span>
        <div class="dropdown" style="padding: 0 8px;">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            10
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">10</a></li>
            <li><a class="dropdown-item" href="#">20</a></li>
            <li><a class="dropdown-item" href="#">50</a></li>
          </ul>
        </div>
        <span class="mr-2">Baris</span>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>
@endsection
