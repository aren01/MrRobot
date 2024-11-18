<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use App\Models\Employees;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ensure these models exist and are correctly set up
        $simulationCount = Simulation::count();
        $employeeCount = Employees::count();

        return view('dashboard', compact('simulationCount', 'employeeCount'));
    }
}
