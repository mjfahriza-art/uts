@php
    $membership = $membership ?? null;
    $members = $members ?? collect();
    $trainers = $trainers ?? collect();
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col">
                <h5 class="card-title">{{ $membership ? 'Edit Membership' : 'Tambah Membership Baru' }}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="member_id" class="form-label">Member</label>
                <select id="member_id" name="member_id" class="form-select" required>
                    <option value="">Pilih Member</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id', $membership->member_id ?? '') == $member->id ? 'selected' : '' }}>{{ $member->name }} ({{ $member->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="trainer_id" class="form-label">Trainer</label>
                <select id="trainer_id" name="trainer_id" class="form-select" required>
                    <option value="">Pilih Trainer</option>
                    @foreach ($trainers as $trainer)
                        <option value="{{ $trainer->id }}" {{ old('trainer_id', $membership->trainer_id ?? '') == $trainer->id ? 'selected' : '' }}>{{ $trainer->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="package" class="form-label">Paket</label>
                <input id="package" name="package" type="text" class="form-control" value="{{ old('package', $membership->package ?? '') }}" placeholder="Contoh: Bulanan, Tahunan" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Harga (Rp)</label>
                <input id="price" name="price" type="number" class="form-control" value="{{ old('price', $membership->price ?? '') }}" placeholder="100000" min="0" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input id="start_date" name="start_date" type="date" class="form-control" value="{{ old('start_date', isset($membership) ? $membership->start_date->format('Y-m-d') : '') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="end_date" class="form-label">Tanggal Selesai</label>
                <input id="end_date" name="end_date" type="date" class="form-control" value="{{ old('end_date', isset($membership) ? $membership->end_date->format('Y-m-d') : '') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="active" {{ old('status', $membership->status ?? '') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ old('status', $membership->status ?? '') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                <option value="suspended" {{ old('status', $membership->status ?? '') == 'suspended' ? 'selected' : '' }}>Ditangguhkan</option>
                <option value="cancelled" {{ old('status', $membership->status ?? '') == 'cancelled' ? 'selected' : '' }}>Berhenti</option>
                <option value="expired" {{ old('status', $membership->status ?? '') == 'expired' ? 'selected' : '' }}>Habis Masa Membership</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ $membership ? 'Update Membership' : 'Simpan Membership' }}
            </button>
            <a href="{{ route('memberships.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </div>
</div>

