<?php

use App\Http\Controllers\Mail\PhishingSimulationController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SlackBotController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BreachCheckController;
use App\Http\Controllers\DashboardController;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('landing');
});

Route::middleware('auth')->group(function () {

    Route::get('phishing_simulation', [PhishingSimulationController::class, 'index'])->name('phishing.simulation');
    Route::post('phishing_simulation/send', [PhishingSimulationController::class, 'sendPhishingEmail'])->name('phishing.simulation.send');
    Route::get('phishing_simulation/{simulation}', [PhishingSimulationController::class, 'show'])->name('phishing.simulation.show');
    Route::get('/phishing/{simulation}/{employee}/track', [PhishingSimulationController::class, 'track'])->name('phishing.simulation.track');
    Route::post('/phishing/{simulation}/{employee}/submit', [PhishingSimulationController::class, 'submitForm'])->name('phishing.simulation.submitForm');
    Route::delete('phishing/destroy/{id}', [PhishingSimulationController::class, 'destroy'])->name('phishing.simulation.destroy');

    // Route to view the details of an employee's form submission
    Route::get('/phishing/{simulationId}/{employeeId}/view-details', [PhishingSimulationController::class, 'viewDetails'])
        ->name('phishing.simulation.viewDetails');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('employees', EmployeesController::class);

    Route::resource('breach-checks', BreachCheckController::class);
    // Route to perform a breach check 
    Route::post('breach-checks/check', [BreachCheckController::class, 'check'])->name('breach-checks.check');
});
