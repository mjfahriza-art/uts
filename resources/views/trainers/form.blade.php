@php
    $trainer = $trainer ?? null;
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
                <h5 class="card-title">{{ $trainer ? 'Edit Trainer' : 'Tambah Trainer Baru' }}</h5>
            </div>
        </div>

        @if ($trainer)
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input id="id" type="text" class="form-control" value="{{ $trainer->id }}" readonly disabled>
        </div>
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nama Trainer</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $trainer->name ?? '') }}" placeholder="Masukkan nama trainer" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">No. HP</label>
            <input id="phone" name="phone" type="text" class="form-control" value="{{ old('phone', $trainer->phone ?? '') }}" placeholder="0812xxxxxxx">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea id="address" name="address" class="form-control" rows="3" placeholder="Masukkan alamat trainer" required>{{ old('address', $trainer->address ?? '') }}</textarea>
        </div>

        @if($trainer)
        <div class="mb-3">
            <label for="photo" class="form-label">Foto</label>
            @if($trainer->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $trainer->photo) }}" alt="Foto {{ $trainer->name }}" class="img-thumbnail" style="max-height: 150px;">
                </div>
            @endif
            <input id="photo" name="photo" type="file" class="form-control" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto. Format: jpg, jpeg, png, webp. Maks: 2MB.</small>
        </div>
        @endif

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ $trainer ? 'Update Trainer' : 'Simpan Trainer' }}
            </button>
            <a href="{{ route('trainers.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </div>
</div>

