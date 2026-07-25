@extends('layouts.sbadmin')

@section('content')
    <div class="d-sm-flex align-items-start justify-content-between mb-4">
        <div class="me-3">
            <h1 class="h2 fw-bold mb-1 text-gray-800">Daftar Membership</h1>
            <p class="text-muted mb-0">Tambah, edit, dan hapus data membership member.</p>
        </div>
        <a href="{{ route('memberships.create') }}" class="btn btn-primary shadow-sm align-self-start">
            <i class="fas fa-plus fa-sm text-white"></i> Tambah Membership
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
            <h6 class="m-0 font-weight-bold text-primary">Data Membership</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Member</th>
                            <th>Trainer</th>
                            <th>Paket</th>
                            <th>Harga</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($memberships as $membership)
                            <tr>
                                <td>{{ $loop->iteration + ($memberships->currentPage() - 1) * $memberships->perPage() }}</td>
                                <td>{{ $membership->id }}</td>
                                <td>
                                    @if($membership->photo)
                                        <img src="{{ asset('storage/' . $membership->photo) }}" alt="Foto Membership" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $membership->member->name ?? '-' }}</td>
                                <td>{{ $membership->trainer->name ?? '-' }}</td>
                                <td>{{ $membership->package }}</td>
                                <td>Rp {{ number_format($membership->price, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($membership->start_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($membership->end_date)->format('d/m/Y') }}</td>
                                <td>
                                    @if($membership->status == 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($membership->status == 'inactive')
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @elseif($membership->status == 'suspended')
                                        <span class="badge bg-warning text-dark">Ditangguhkan</span>
                                    @elseif($membership->status == 'cancelled')
                                        <span class="badge bg-danger">Berhenti</span>
                                    @elseif($membership->status == 'expired')
                                        <span class="badge bg-dark">Habis Masa</span>
                                    @endif
                                </td>
                                <td style="white-space: normal;">
                                    <div class="d-flex flex-nowrap gap-1">
                                        <a href="{{ route('memberships.show', $membership) }}" class="btn btn-sm btn-info text-white">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('memberships.edit', $membership) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('memberships.destroy', $membership) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus membership ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">Belum ada membership, silakan tambah data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $memberships->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

