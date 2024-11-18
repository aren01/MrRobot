<?php

namespace App\Http\Controllers;

use App\Models\BreachCheck;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BreachCheckController extends Controller
{
    public function index()
    {
        $breachChecks = BreachCheck::all();
        return view('breach-checks.index', compact('breachChecks'));
    }

    public function create()
    {
        $employees = Employees::all();
        return view('breach-checks.create', compact('employees'));
    }

    public function check(Request $request)
    {
        $request->validate([
            'employee_ids' => 'required|array',
            'employee_ids.*' => 'exists:employees,id',
        ]);

        $employees = Employees::whereIn('id', $request->employee_ids)->get();
        $apiKey = env('LEAK_LOOKUP_API_KEY');
        $breachDetails = [];

        foreach ($employees as $employee) {
            $response = Http::asForm()->post("https://leak-lookup.com/api/search", [
                'key' => $apiKey,
                'type' => 'email_address',
                'query' => $employee->email,
            ]);

            // Log the response to see its structure
            Log::info('API Response for ' . $employee->email . ': ' . $response->body());

            if ($response->successful()) {
                $details = $response->json();

                if (isset($details['message']) && is_array($details['message'])) {
                    $breachDetails[] = [
                        'email' => $employee->email,
                        'details' => $details['message']
                    ];
                } else {
                    Log::error('Unexpected API response format for email: ' . $employee->email . ' - ' . json_encode($details));
                }
            } else {
                Log::error('Leak-Lookup API Error: ' . $response->body());
                return redirect()->route('breach-checks.index')->with('error', 'Failed to complete breach check.');
            }
        }

        Log::info('Breach Details: ' . json_encode($breachDetails));

        $breachCheck = new BreachCheck;
        $breachCheck->details = json_encode($breachDetails);
        $breachCheck->save();

        return redirect()->route('breach-checks.index')->with('success', 'Breach check completed successfully!');
    }

    public function show(BreachCheck $breachCheck)
    {
        // Decode the 'details' column as JSON
        $breachDetails = json_decode($breachCheck->details, true);

        // Check if decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            return redirect()->route('breach-checks.index')->with('error', 'Failed to retrieve breach details.');
        }

        // Pass the data to the view
        return view('breach-checks.show', compact('breachCheck', 'breachDetails'));
    }

    public function destroy(BreachCheck $breachCheck)
    {
        $breachCheck->delete();

        return redirect()->route('breach-checks.index')->with('success', 'Breach check deleted successfully!');
    }
}
