<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Membership;
use App\Models\Trainer;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $this->autoExpire();

        $memberships = Membership::with(['member', 'trainer'])->latest()->paginate(10);

        return view('memberships.index', compact('memberships'));
    }

    protected function autoExpire(): void
    {
        Membership::where('status', 'active')
            ->where('end_date', '<', now()->toDateString())
            ->update(['status' => 'expired']);
    }

    public function create()
    {
        $members = Member::orderBy('name')->get();
        $trainers = Trainer::orderBy('name')->get();

        return view('memberships.create', compact('members', 'trainers'));
    }

public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => ['required', 'exists:members,id'],
            'trainer_id' => ['required', 'exists:trainers,id'],
            'package' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:active,inactive,suspended,cancelled,expired'],
            'duration_quantity' => ['required', 'integer', 'min:1'],
            'duration_unit' => ['required', 'in:bulan,tahun'],
        ]);

$data['start_date'] = now()->toDateString();
        $data['end_date'] = $this->calculateEndDate($data['duration_quantity'], $data['duration_unit'], $data['start_date']);
        $data['price'] = $this->calculatePrice($data['package'], $data['duration_quantity'], $data['duration_unit']);

        unset($data['duration_quantity'], $data['duration_unit']);

        Membership::create($data);

        return redirect()->route('memberships.index')->with('success', 'Membership berhasil ditambahkan.');
    }

protected function calculateEndDate(int $quantity, string $unit, string $startDate): string
    {
        $start = \Carbon\Carbon::parse($startDate);

        if ($unit === 'tahun') {
            return $start->addYears($quantity)->toDateString();
        }

        return $start->addMonths($quantity)->toDateString();
    }

    protected function calculatePrice(string $package, int $quantity, string $unit): float
    {
        $rates = [
            'gold'   => ['bulan' => 1000000,  'tahun' => 12000000],
            'silver' => ['bulan' => 500000,   'tahun' => 6000000],
            'bronze' => ['bulan' => 300000,   'tahun' => 3600000],
        ];

        $package = strtolower($package);

        if (!isset($rates[$package])) {
            return 0;
        }

        return (float) $rates[$package][$unit] * $quantity;
    }

    public function show(Membership $membership)
    {
        $this->autoExpire();

        $membership->load(['member', 'trainer']);

        return view('memberships.show', compact('membership'));
    }

    public function edit(Membership $membership)
    {
        $members = Member::orderBy('name')->get();
        $trainers = Trainer::orderBy('name')->get();

        return view('memberships.edit', compact('membership', 'members', 'trainers'));
    }

public function update(Request $request, Membership $membership)
    {
        $data = $request->validate([
            'member_id' => ['required', 'exists:members,id'],
            'trainer_id' => ['required', 'exists:trainers,id'],
            'package' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:active,inactive,suspended,cancelled,expired'],
            'duration_quantity' => ['required', 'integer', 'min:1'],
            'duration_unit' => ['required', 'in:bulan,tahun'],
        ]);

        if ($membership->start_date) {
            $membership->end_date = $this->calculateEndDate(
                $data['duration_quantity'],
                $data['duration_unit'],
                $membership->start_date->toDateString()
            );
        }

$data['price'] = $this->calculatePrice($data['package'], $data['duration_quantity'], $data['duration_unit']);

        unset($data['duration_quantity'], $data['duration_unit']);

        $data['end_date'] = $membership->end_date;

        $membership->update($data);

        return redirect()->route('memberships.index')->with('success', 'Membership berhasil diperbarui.');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();

        return redirect()->route('memberships.index')->with('success', 'Membership berhasil dihapus.');
    }
}
