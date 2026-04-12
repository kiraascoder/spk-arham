<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClassifications = Classification::where('user_id', Auth::id())->count();
        $lastClassification = Classification::where('user_id', Auth::id())->latest()->first();

        return view('user.dashboard', compact('totalClassifications', 'lastClassification'));
    }
}
