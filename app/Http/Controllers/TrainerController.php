<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Gym::withCount('members')->latest()->paginate(10);

        return view('trainers.index', compact('trainers'));
    }

    public function create()
    {
        return view('trainers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        Gym::create($data);

        return redirect()->route('trainers.index')->with('success', 'Trainer berhasil ditambahkan.');
    }

    public function edit(Gym $trainer)
    {
        $trainer->loadCount('members');

        return view('trainers.edit', compact('trainer'));
    }

    public function update(Request $request, Gym $trainer)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $trainer->update($data);

        return redirect()->route('trainers.index')->with('success', 'Trainer berhasil diperbarui.');
    }

    public function show(Gym $trainer)
    {
        $trainer->loadCount('members');
        $trainer->load('members');

        return view('trainers.show', compact('trainer'));
    }

    public function destroy(Gym $trainer)
    {
        $trainer->delete();

        return redirect()->route('trainers.index')->with('success', 'Trainer berhasil dihapus.');
    }
}

