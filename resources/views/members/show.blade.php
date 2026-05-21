@extends('layouts.sbadmin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Detail Member</h1>
            <p class="text-muted">Informasi lengkap tentang member gym.</p>
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
                        <div class="col-sm-4 text-muted">Gym</div>
                        <div class="col-sm-8">{{ $member->gym->name ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Alamat Gym</div>
                        <div class="col-sm-8">{{ $member->gym->address ?? '-' }}</div>
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
