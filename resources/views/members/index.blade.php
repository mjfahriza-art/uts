@extends('layouts.sbadmin')

@section('content')
    <div class="d-sm-flex align-items-start justify-content-between mb-4">
        <div class="me-3">
            <h1 class="h2 fw-bold mb-1 text-gray-800">Daftar Member</h1>
            <p class="text-muted mb-0">Tambah, edit, dan hapus data member gym.</p>
        </div>
        <a href="{{ route('members.create') }}" class="btn btn-primary shadow-sm align-self-start">
            <i class="fas fa-plus fa-sm text-white"></i> Tambah Member
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Member</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Gym</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                            <tr>
                                <td>{{ $loop->iteration + ($members->currentPage() - 1) * $members->perPage() }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->phone ?? '-' }}</td>
                                <td>{{ $member->gym->name ?? '-' }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus member ini?');">
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
                                <td colspan="6" class="text-center">Belum ada member, silakan tambah data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $members->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
