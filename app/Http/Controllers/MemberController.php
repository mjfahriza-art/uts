<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('trainer')->latest()->paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        $trainers = Trainer::orderBy('name')->get();

        return view('members.create', compact('trainers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'trainer_id' => ['required', 'exists:trainers,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:members,email'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        Member::create($data);

        return redirect()->route('members.index')->with('success', 'Member berhasil ditambahkan.');
    }

    public function edit(Member $member)
    {
        $trainers = Trainer::orderBy('name')->get();

        return view('members.edit', compact('member', 'trainers'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'trainer_id' => ['required', 'exists:trainers,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:members,email,' . $member->id],
            'phone' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($member->photo && \Storage::disk('public')->exists($member->photo)) {
                \Storage::disk('public')->delete($member->photo);
            }
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $member->update($data);

        return redirect()->route('members.index')->with('success', 'Member berhasil diperbarui.');
    }

    public function toggleStatus(Member $member)
    {
        $member->update([
            'is_active' => !$member->is_active,
        ]);

        $status = $member->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('members.index')->with('success', "Status member berhasil {$status}.");
    }

    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member berhasil dihapus.');
    }
}
