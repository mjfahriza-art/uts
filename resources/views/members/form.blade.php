@php
    $member = $member ?? null;
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
                <h5 class="card-title">{{ $member ? 'Edit Member' : 'Tambah Member Baru' }}</h5>
            </div>
        </div>

        <div class="mb-3">
            <label for="trainer_id" class="form-label">Trainer</label>
            <select id="trainer_id" name="trainer_id" class="form-select">
                <option value="">Pilih Trainer</option>
                @foreach ($trainers as $trainer)
                    <option value="{{ $trainer->id }}" {{ old('trainer_id', $member->trainer_id ?? '') == $trainer->id ? 'selected' : '' }}>{{ $trainer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $member->name ?? '') }}" placeholder="Masukkan nama member">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $member->email ?? '') }}" placeholder="member@example.com">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input id="phone" name="phone" type="text" class="form-control" value="{{ old('phone', $member->phone ?? '') }}" placeholder="0812xxxxxxx">
        </div>

        @if($member)
        <div class="mb-3">
            <label for="is_active" class="form-label">Status</label>
            <select id="is_active" name="is_active" class="form-select">
                <option value="1" {{ old('is_active', $member->is_active ?? '') == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('is_active', $member->is_active ?? '') === 0 || old('is_active', $member->is_active ?? '') === '0' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        @endif

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ $member ? 'Update Member' : 'Simpan Member' }}
            </button>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </div>
</div>
