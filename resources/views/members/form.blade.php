@php
    $member = $member ?? null;
    $gyms = $gyms ?? collect();
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
            <label for="gym_id" class="form-label">Gym</label>
            <select id="gym_id" name="gym_id" class="form-select">
                <option value="">Pilih Gym</option>
                @foreach ($gyms as $gym)
                    <option value="{{ $gym->id }}" {{ old('gym_id', $member->gym_id ?? '') == $gym->id ? 'selected' : '' }}>{{ $gym->name }}</option>
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

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">{{ $member ? 'Update Member' : 'Simpan Member' }}</button>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>
