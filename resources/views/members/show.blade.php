@extends('layouts.sbadmin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Detail Member</h1>
            <p class="text-muted">Informasi lengkap tentang member trainer.</p>
        </div>
        <a href="{{ route('members.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profil Member</h6>
                </div>
                <div class="card-body">
                    @if($member->photo)
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $member->photo) }}" alt="Foto {{ $member->name }}" class="img-fluid rounded shadow" style="max-height: 300px; object-fit: contain;">
                        </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Nama</div>
                        <div class="col-sm-8">{{ $member->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Email</div>
                        <div class="col-sm-8">{{ $member->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Telepon</div>
                        <div class="col-sm-8">{{ $member->phone ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Trainer</div>
                        <div class="col-sm-8">{{ $member->trainer->name ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Alamat Trainer</div>
                        <div class="col-sm-8">{{ $member->trainer->address ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Status</div>
                        <div class="col-sm-8">
                            @if($member->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Hapus member ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
