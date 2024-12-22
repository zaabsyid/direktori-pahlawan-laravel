@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-4">Direktori Pahlawan</h1>
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Daftar Pahlawan</h3>
                        <!-- Tombol Export PDF -->
                        <div>
                            <a href="{{ route('pahlawans.exportPdf') }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </a>
                        </div>
                        <!-- Form Pencarian -->
                        <form action="{{ route('pahlawans') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Cari Nama Pahlawan"
                                value="{{ request('search') }}">
                            <button type="submit" class="btn btn-light">Cari</button>
                        </form>
                    </div>
                    <div class="card-body">
                        @if ($pahlawans->count())
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama Pahlawan</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pahlawans as $index => $pahlawan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <img src="{{ Storage::url($pahlawan->photo) }}" alt="{{ $pahlawan->name }}"
                                                    class="img-thumbnail" style="width: 100px; height: auto;">
                                            </td>
                                            <td>{{ $pahlawan->name }}</td>
                                            <td>{{ $pahlawan->description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center">Tidak ada data pahlawan ditemukan.</p>
                        @endif
                    </div>
                    {{-- <div class="card-footer text-center">
                        <small>&copy; {{ date('Y') }} Direktori Pahlawan</small>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
