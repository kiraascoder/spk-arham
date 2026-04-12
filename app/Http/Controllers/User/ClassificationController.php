<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use App\Models\ClassificationDetail;
use App\Models\Criterion;
use App\Services\NaiveBayesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ClassificationController extends Controller
{
    protected NaiveBayesService $naiveBayesService;

    public function __construct(NaiveBayesService $naiveBayesService)
    {
        $this->naiveBayesService = $naiveBayesService;
    }

    public function create()
    {
        $criteria = Criterion::with('options')->get();

        return view('user.classification.create', compact('criteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'criteria' => 'required|array',
            'criteria.*' => 'required|string',
        ]);

        $result = $this->naiveBayesService->classify($request->criteria);

        $classification = DB::transaction(function () use ($request, $result) {
            $classification = Classification::create([
                'user_id' => Auth::id(),
                'classification_code' => 'CLS-' . now()->format('YmdHis'),
                'predicted_class' => $result['predicted_class'],
                'probability_unggul' => $result['probability_unggul'],
                'probability_tidak_unggul' => $result['probability_tidak_unggul'],
                'calculation_details' => $result['calculation_details'],
            ]);

            foreach ($request->criteria as $criterionId => $value) {
                ClassificationDetail::create([
                    'classification_id' => $classification->id,
                    'criterion_id' => $criterionId,
                    'input_value' => $value,
                    'normalized_value' => strtolower(str_replace(' ', '_', $value)),
                ]);
            }

            return $classification;
        });

        return redirect()->route('user.classification.result', $classification->id);
    }

    public function result($id)
    {
        $classification = Classification::with('details.criterion', 'user')->findOrFail($id);

        return view('user.classification.result', compact('classification'));
    }

    public function history()
    {
        $histories = Classification::with('details.criterion')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.history.index', compact('histories'));
    }
    public function downloadPdf($id)
    {
        $classification = Classification::with('details.criterion', 'user')->findOrFail($id);

        if ($classification->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        $pdf = Pdf::loadView('user.classification.pdf', [
            'classification' => $classification,
        ]);

        $fileName = $classification->classification_code . '.pdf';
        $filePath = 'reports/' . $fileName;

        Storage::disk('public')->put($filePath, $pdf->output());

        $classification->update([
            'pdf_path' => $filePath,
        ]);

        return $pdf->download($fileName);
    }
}
