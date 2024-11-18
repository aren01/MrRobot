<?php

namespace App\Http\Controllers\Mail;

use App\Mail\PhishingSimulationMail;
use App\Models\Simulation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\Employees; // Correct model name
use Illuminate\Support\Facades\Log;

class PhishingSimulationController extends Controller
{
    public function index()
    {
        $simulations = Simulation::with('employees')->get();
        return view('phishing_simulation.index', compact('simulations'));
    }

    public function sendPhishingEmail()
    {
        $simulation = Simulation::create(['email_sent' => true, 'simulated_at' => now()]); // Ensure the simulation is created before attaching employees 
        $employees = Employees::all(); // Create and save the simulation first 
        if ($simulation) {
            foreach ($employees as $employee) {
                $simulation->employees()->attach($employee->id, ['status' => 'not opened']);
                $url = route('phishing.simulation.track', ['simulation' => $simulation->id, 'employee' => $employee->id]);
                Mail::to($employee->email)->send(new PhishingSimulationMail($url));
            }
        }
        return redirect()->route('phishing.simulation')->with('status', 'Simulations sent successfully!');
    }

    public function track($simulationId, $employeeId)
    {
        // Retrieve the simulation along with its employees
        $simulation = Simulation::with('employees')->findOrFail($simulationId);

        // Update the status to 'opened' for the specific employee in the pivot table
        $simulation->employees()->updateExistingPivot($employeeId, ['status' => 'opened']);

        // Find the specific employee being tracked
        $employee = $simulation->employees->find($employeeId);

        // Get the submitted details for the specific employee
        $submittedDetails = [
            'email' => $employee->pivot->email ?? 'No details submitted',
            'password' => $employee->pivot->password ?? 'No details submitted'
        ];

        // Pass the simulation, employee, and submitted details to the view
        return view('phishing_simulation.form', compact('simulation', 'employee', 'submittedDetails'));
    }




    // In the controller method that handles the form submission
    public function submitForm(Request $request, $simulationId, $employeeId)
    {
        $simulation = Simulation::with('employees')->findOrFail($simulationId);

        // Log the submitted form data
        Log::info('Submitted Form Data: ', $request->all());

        // Update the pivot table with the submitted details in JSON format
        $result = $simulation->employees()->updateExistingPivot($employeeId, [
            'submitted_details' => json_encode([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ]),
            'status' => 'filled information'
        ]);

        // Check if the update was successful
        if ($result) {
            Log::info('Pivot Table Updated Successfully');
        } else {
            Log::error('Failed to Update Pivot Table');
        }

        // Log the updated pivot data for debugging
        $updatedEmployee = $simulation->employees()->wherePivot('employee_id', $employeeId)->first();
        Log::info('Updated Pivot Data: ', [$updatedEmployee ? $updatedEmployee->pivot->submitted_details : 'No data found']);

        return redirect()->away('https://www.google.com');
    }



    public function show($id)
    {
        $simulation = Simulation::with('employees')->findOrFail($id);
        return view('phishing_simulation.show', compact('simulation'));
    }

    public function destroy($id)
    {
        $simulation = Simulation::findOrFail($id);
        $simulation->delete();
        return redirect()->route('phishing.simulation')->with('status', 'Simulation deleted successfully!');
    }

    public function viewDetails($simulationId, $employeeId)
    {
        $simulation = Simulation::with('employees')->findOrFail($simulationId);
        $employee = $simulation->employees->find($employeeId);

        // Log the raw submitted details from the pivot table
        Log::info('Raw Submitted Details: ' . $employee->pivot->submitted_details);

        // Decode the submitted details from the pivot table
        $submittedDetails = !empty($employee->pivot->submitted_details) ? json_decode($employee->pivot->submitted_details, true) : null;

        // If no details are found, set default values
        if (!$submittedDetails) {
            $submittedDetails = [
                'email' => 'No details submitted yet',
                'password' => 'No details submitted yet',
            ];
        }

        return view('phishing_simulation.view_details', compact('simulation', 'employee', 'submittedDetails'));
    }
}
