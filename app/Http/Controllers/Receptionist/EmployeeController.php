<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\DrinkConsumable;

class EmployeeController extends Controller
{
    // Display a listing of employees
    public function index()
    {
        $employees = Employee::all();
        $drinkConsumables = DrinkConsumable::all(); // Fetch all drink consumables
        return view('receptionist.employees.index', compact('employees', 'drinkConsumables'));
    }

    // Show the form for creating a new employee
    public function create()
    {
        return view('receptionist.employees.create');
    }

    // Store a newly created employee in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
        ]);

        Employee::create($request->all());

        return redirect()->route('receptionist.employees.index')->with('success', 'Funcionário criado com sucesso.');
    }

    // Show the form for editing the specified employee
    public function edit(Employee $employee)
    {
        return view('receptionist.employees.edit', compact('employee'));
    }

    // Update the specified employee in storage
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
        ]);

        $employee->update($request->all());

        return redirect()->route('receptionist.employees.index')->with('success', 'Funcionário atualizado com sucesso.');
    }

    // Remove the specified employee from storage
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('receptionist.employees.index')->with('success', 'Funcionário excluído com sucesso.');
    }
}
