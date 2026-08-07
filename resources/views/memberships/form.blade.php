@php
    $membership = $membership ?? null;
    $members = $members ?? collect();
    $trainers = $trainers ?? collect();

    // Hitung durasi dari start_date/end_date saat edit
    $defaultQty = old('duration_quantity', 1);
    $defaultUnit = old('duration_unit', 'bulan');
    if ($membership && $membership->start_date && $membership->end_date) {
        try {
            $diff = $membership->start_date->diff($membership->end_date);
            if ($diff->y > 0) {
                $defaultUnit = 'tahun';
                $defaultQty = $diff->y;
            } else {
                $defaultUnit = 'bulan';
                $defaultQty = max(1, $diff->m);
            }
        } catch (\Throwable $e) {
            // abaikan
        }
    }
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
                <label for="package" class="form-label">Tipe Membership</label>
                <select id="package" name="package" class="form-select" required>
                    <option value="">Pilih Tipe Membership</option>
                    @php
                        $packages = [
                            'gold'   => ['label' => 'Gold',   'bulan' => 1000000,  'tahun' => 12000000],
                            'silver' => ['label' => 'Silver', 'bulan' => 500000,   'tahun' => 6000000],
                            'bronze' => ['label' => 'Bronze', 'bulan' => 300000,   'tahun' => 3600000],
                        ];
                        $selectedPackage = old('package', $membership->package ?? '');
                    @endphp
                    @foreach ($packages as $key => $pkg)
                        <option value="{{ $key }}" {{ $selectedPackage == $key ? 'selected' : '' }}>
                            {{ $pkg['label'] }} — Rp {{ number_format($pkg['bulan'], 0, ',', '.') }}/bulan · Rp {{ number_format($pkg['tahun'], 0, ',', '.') }}/tahun
                        </option>
                    @endforeach
                </select>
                <div class="form-text">Harga otomatis dihitung dari tipe & durasi membership.</div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Harga (Rp)</label>
                <input id="price" name="price" type="text" class="form-control" value="{{ old('price', $membership->price ?? '') }}" placeholder="-" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="alert alert-info py-2 mb-0">
                    <strong>Tabel Tarif:</strong>
                    <ul class="mb-0 ps-3">
                        <li>Gold: Rp 1.000.000/bulan · Rp 12.000.000/tahun</li>
                        <li>Silver: Rp 500.000/bulan · Rp 6.000.000/tahun</li>
                        <li>Bronze: Rp 300.000/bulan · Rp 3.600.000/tahun</li>
                    </ul>
                </div>
            </div>
        </div>

<div class="row">
            <div class="col-md-6 mb-3">
                <label for="duration_quantity" class="form-label">Durasi Membership</label>
                <div class="input-group">
                    <input id="duration_quantity" name="duration_quantity" type="number" class="form-control" value="{{ $defaultQty }}" min="1" max="11" required>
                    <select id="duration_unit" name="duration_unit" class="form-select" style="max-width: 140px;" required>
                        <option value="bulan" {{ $defaultUnit == 'bulan' ? 'selected' : '' }}>Bulan</option>
                        <option value="tahun" {{ $defaultUnit == 'tahun' ? 'selected' : '' }}>Tahun</option>
                    </select>
                </div>
                <div class="form-text">Pilih jumlah bulan (1-11) atau tahun (1-5).</div>
            </div>

<div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="active" {{ old('status', $membership->status ?? '') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status', $membership->status ?? '') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    <option value="suspended" {{ old('status', $membership->status ?? '') == 'suspended' ? 'selected' : '' }}>Ditangguhkan</option>
                    <option value="cancelled" {{ old('status', $membership->status ?? '') == 'cancelled' ? 'selected' : '' }}>Berhenti</option>
                    <option value="expired" {{ old('status', $membership->status ?? '') == 'expired' ? 'selected' : '' }}>Habis Masa Membership</option>
                </select>
            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const packageSelect = document.getElementById('package');
        const qtyInput = document.getElementById('duration_quantity');
        const unitSelect = document.getElementById('duration_unit');
        const priceInput = document.getElementById('price');

        const rates = {
            gold:   { bulan: 1000000, tahun: 12000000 },
            silver: { bulan:  500000, tahun:  6000000 },
            bronze: { bulan:  300000, tahun:  3600000 },
        };

        function updatePrice() {
            const pkg = packageSelect.value;
            const unit = unitSelect.value;
            const qty = parseInt(qtyInput.value, 10) || 0;

            if (!pkg || !rates[pkg] || qty <= 0) {
                priceInput.value = '';
                return;
            }

            priceInput.value = rates[pkg][unit] * qty;
        }

        packageSelect.addEventListener('change', updatePrice);
        qtyInput.addEventListener('input', updatePrice);
        unitSelect.addEventListener('change', updatePrice);

        // Jalankan sekali saat halaman dimuat (untuk mode edit)
        updatePrice();
    });
</script>
