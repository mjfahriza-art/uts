@extends('layouts.sbadmin')

@section('content')
    <div class="d-sm-flex align-items-start justify-content-between mb-4">
        <div class="me-3">
            <h1 class="h2 fw-bold mb-1 text-gray-800">Daftar Trainer</h1>
            <p class="text-muted mb-0">Tambah, edit, dan hapus data trainer.</p>
        </div>
        <a href="{{ route('trainers.create') }}" class="btn btn-primary shadow-sm align-self-start">
            <i class="fas fa-plus fa-sm text-white"></i> Tambah Trainer
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Trainer</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Jumlah Member</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trainers as $trainer)
                            <tr>
                                <td>{{ $loop->iteration + ($trainers->currentPage() - 1) * $trainers->perPage() }}</td>
                                <td>{{ $trainer->id }}</td>
                                <td>
                                    @if($trainer->photo)
                                        <img src="{{ asset('storage/' . $trainer->photo) }}" alt="Foto {{ $trainer->name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $trainer->name }}</td>
                                <td>{{ $trainer->phone ?? '-' }}</td>
                                <td>{{ $trainer->address }}</td>
                                <td>{{ $trainer->members_count }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('trainers.show', $trainer) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('trainers.edit', $trainer) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('trainers.destroy', $trainer) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus trainer ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada trainer, silakan tambah data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $trainers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

