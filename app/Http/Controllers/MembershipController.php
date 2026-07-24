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
        $memberships = Membership::with(['member', 'trainer'])->latest()->paginate(10);

        return view('memberships.index', compact('memberships'));
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
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        Membership::create($data);

        return redirect()->route('memberships.index')->with('success', 'Membership berhasil ditambahkan.');
    }

    public function show(Membership $membership)
    {
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
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $membership->update($data);

        return redirect()->route('memberships.index')->with('success', 'Membership berhasil diperbarui.');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();

        return redirect()->route('memberships.index')->with('success', 'Membership berhasil dihapus.');
    }
}

