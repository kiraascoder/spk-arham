<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criterion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CriterionController extends Controller
{
    public function index()
    {
        $criteria = Criterion::with('options')->latest()->get();

        return view('admin.criteria.index', compact('criteria'));
    }

    public function create()
    {
        return view('admin.criteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'input_type' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        Criterion::create([
            'code' => Str::slug($request->name, '_'),
            'name' => $request->name,
            'input_type' => $request->input_type,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.criteria.index')->with('success', 'Data kriteria berhasil ditambahkan.');
    }

    public function edit(Criterion $criterion)
    {
        return view('admin.criteria.edit', compact('criterion'));
    }

    public function update(Request $request, Criterion $criterion)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'input_type' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        $criterion->update([
            'name' => $request->name,
            'input_type' => $request->input_type,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.criteria.index')->with('success', 'Data kriteria berhasil diubah.');
    }

    public function destroy(Criterion $criterion)
    {
        $criterion->delete();

        return redirect()->route('admin.criteria.index')->with('success', 'Data kriteria berhasil dihapus.');
    }
}
