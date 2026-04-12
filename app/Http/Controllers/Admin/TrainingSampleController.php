<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criterion;
use App\Models\TrainingSample;
use App\Models\TrainingSampleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainingSampleController extends Controller
{
    public function index()
    {
        $samples = TrainingSample::with('details.criterion')->latest()->get();

        return view('admin.training.index', compact('samples'));
    }

    public function create()
    {
        $criteria = Criterion::with('options')->get();

        return view('admin.training.create', compact('criteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sample_code' => 'required|string|max:50|unique:training_samples,sample_code',
            'class_label' => 'required|in:unggul,tidak_unggul',
            'criteria' => 'required|array',
            'criteria.*' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            $sample = TrainingSample::create([
                'sample_code' => $request->sample_code,
                'class_label' => $request->class_label,
                'source_data' => 'Input Admin',
                'notes' => $request->notes,
            ]);

            foreach ($request->criteria as $criterionId => $value) {
                TrainingSampleDetail::create([
                    'training_sample_id' => $sample->id,
                    'criterion_id' => $criterionId,
                    'option_value' => $value,
                    'normalized_value' => strtolower(str_replace(' ', '_', $value)),
                ]);
            }
        });

        return redirect()->route('admin.training.index')->with('success', 'Data training berhasil ditambahkan.');
    }

    public function edit(TrainingSample $trainingSample)
    {
        $criteria = Criterion::with('options')->get();
        $trainingSample->load('details');

        $detailMap = $trainingSample->details->pluck('option_value', 'criterion_id');

        return view('admin.training.edit', compact('trainingSample', 'criteria', 'detailMap'));
    }

    public function update(Request $request, TrainingSample $trainingSample)
    {
        $request->validate([
            'sample_code' => 'required|string|max:50|unique:training_samples,sample_code,' . $trainingSample->id,
            'class_label' => 'required|in:unggul,tidak_unggul',
            'criteria' => 'required|array',
            'criteria.*' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $trainingSample) {
            $trainingSample->update([
                'sample_code' => $request->sample_code,
                'class_label' => $request->class_label,
                'notes' => $request->notes,
            ]);

            $trainingSample->details()->delete();

            foreach ($request->criteria as $criterionId => $value) {
                TrainingSampleDetail::create([
                    'training_sample_id' => $trainingSample->id,
                    'criterion_id' => $criterionId,
                    'option_value' => $value,
                    'normalized_value' => strtolower(str_replace(' ', '_', $value)),
                ]);
            }
        });

        return redirect()->route('admin.training.index')->with('success', 'Data training berhasil diubah.');
    }

    public function destroy(TrainingSample $trainingSample)
    {
        $trainingSample->delete();

        return redirect()->route('admin.training.index')->with('success', 'Data training berhasil dihapus.');
    }
}
