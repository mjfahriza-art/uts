<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('gym')->latest()->paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        $gyms = Gym::orderBy('name')->get();

        return view('members.create', compact('gyms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gym_id' => ['required', 'exists:gyms,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:members,email'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        Member::create($data);

        return redirect()->route('members.index')->with('success', 'Member berhasil ditambahkan.');
    }

    public function edit(Member $member)
    {
        $gyms = Gym::orderBy('name')->get();

        return view('members.edit', compact('member', 'gyms'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'gym_id' => ['required', 'exists:gyms,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:members,email,' . $member->id],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $member->update($data);

        return redirect()->route('members.index')->with('success', 'Member berhasil diperbarui.');
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
