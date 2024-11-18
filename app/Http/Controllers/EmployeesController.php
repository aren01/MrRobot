<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employees::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
        ]);

        Employees::create($request->all());

        return redirect()->route('employees.index')->with('status', 'Employee added successfully!');
    }

    public function edit(Employees $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employees $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('status', 'Employee updated successfully!');
    }

    public function destroy(Employees $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('status', 'Employee deleted successfully!');
    }
}
