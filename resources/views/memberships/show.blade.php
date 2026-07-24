@extends('layouts.sbadmin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Detail Membership</h1>
            <p class="text-muted">Informasi lengkap tentang membership member.</p>
        </div>
        <a href="{{ route('memberships.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Membership</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">ID Membership</div>
                        <div class="col-sm-8">{{ $membership->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Member</div>
                        <div class="col-sm-8">{{ $membership->member->name ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Email Member</div>
                        <div class="col-sm-8">{{ $membership->member->email ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Trainer</div>
                        <div class="col-sm-8">{{ $membership->trainer->name ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Paket</div>
                        <div class="col-sm-8">{{ $membership->package }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Harga</div>
                        <div class="col-sm-8">Rp {{ number_format($membership->price, 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Tanggal Mulai</div>
                        <div class="col-sm-8">{{ \Carbon\Carbon::parse($membership->start_date)->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Tanggal Selesai</div>
                        <div class="col-sm-8">{{ \Carbon\Carbon::parse($membership->end_date)->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Status</div>
                        <div class="col-sm-8">
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
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Dibuat</div>
                        <div class="col-sm-8">{{ $membership->created_at->format('d F Y H:i') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Diperbarui</div>
                        <div class="col-sm-8">{{ $membership->updated_at->format('d F Y H:i') }}</div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('memberships.edit', $membership) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('memberships.destroy', $membership) }}" method="POST" onsubmit="return confirm('Hapus membership ini?');">
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

