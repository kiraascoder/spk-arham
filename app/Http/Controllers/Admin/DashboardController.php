<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use App\Models\Criterion;
use App\Models\TrainingSample;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalCriteria = Criterion::count();
        $totalTraining = TrainingSample::count();
        $totalClassifications = Classification::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCriteria',
            'totalTraining',
            'totalClassifications'
        ));
    }
}
