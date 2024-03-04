<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeDrinkConsumable;
use App\Models\DrinkConsumable;
use Illuminate\Support\Facades\DB;

class EmployeeDrinkConsumableController extends Controller
{
    public function index()
    {
        // Remove the pivot reference
        $employeeDrinkConsumables = EmployeeDrinkConsumable::with(['employee', 'drinkConsumable'])->get();
        return view('receptionist.employee-drink-consumables.index', compact('employeeDrinkConsumables'));
    }

    public function create()
    {
        $employees = Employee::all();
        $drinkConsumables = DrinkConsumable::all();
        return view('receptionist.employee-drink-consumables.create', compact('employees', 'drinkConsumables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'drink_consumable_id' => 'required|exists:drink_consumables,id',
            'quantity' => 'required|numeric',
            'employee_price' => 'required|numeric',
        ]);

        EmployeeDrinkConsumable::create([
            'employee_id' => $request->employee_id,
            'drink_consumable_id' => $request->drink_consumable_id,
            'quantity' => $request->quantity,
            'employee_price' => $request->employee_price,
        ]);

        return redirect()->route('receptionist.employee-drink-consumables.index')->with('success', 'Employee Drink Consumable created successfully.');
    }

    public function edit(EmployeeDrinkConsumable $employeeDrinkConsumable)
    {
        $employees = Employee::all();
        $drinkConsumables = DrinkConsumable::all();
        return view('receptionist.employee-drink-consumables.edit', compact('employeeDrinkConsumable', 'employees', 'drinkConsumables'));
    }

    public function update(Request $request, EmployeeDrinkConsumable $employeeDrinkConsumable)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'drink_consumable_id' => 'required|exists:drink_consumables,id',
            'quantity' => 'required|numeric',
            'employee_price' => 'required|numeric',
        ]);

        $employeeDrinkConsumable->update([
            'employee_id' => $request->employee_id,
            'drink_consumable_id' => $request->drink_consumable_id,
            'quantity' => $request->quantity,
            'employee_price' => $request->employee_price,
        ]);

        return redirect()->route('receptionist.employee-drink-consumables.index')->with('success', 'Bebida (funcionário) atualizada com sucesso.');
    }

    public function destroy(EmployeeDrinkConsumable $employeeDrinkConsumable)
    {
        $employeeDrinkConsumable->delete();
        return back()->with('success', 'Bebida (funcionário) excluída com sucesso.');
    }

    public function buyDrinkForEmployee(Request $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $drinkConsumableId = $request->input('drink_consumable_id');
        $quantityToBuy = $request->input('quantity', 1);

        $drink = DrinkConsumable::findOrFail($drinkConsumableId);
        if ($drink->quantity < $quantityToBuy) {
            return back()->with('error', 'Not enough stock available.');
        }

        // Decrement stock
        $drink->decrement('quantity', $quantityToBuy);

        // Check if there's already a non-paid record for this employee and drink
        $existingRecord = DB::table('employee_drink_consumables')
            ->where('employee_id', $employeeId)
            ->where('drink_consumable_id', $drinkConsumableId)
            ->where('paid', false)
            ->first();

        if ($existingRecord) {
            // Update existing record
            DB::table('employee_drink_consumables')
                ->where('id', $existingRecord->id)
                ->increment('quantity', $quantityToBuy);
        } else {
            // Insert a new record
            DB::table('employee_drink_consumables')->insert([
                'employee_id' => $employeeId,
                'drink_consumable_id' => $drinkConsumableId,
                'quantity' => $quantityToBuy,
                'employee_price' => $drink->employee_price,
                'paid' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Drink purchased successfully for employee.');
    }

    public function markAsPaid(Request $request, $employeeId, $drinkConsumableId)
    {
        // Attempt to mark all unpaid drinks for this employee and drink combination as paid
        $affectedRows = DB::table('employee_drink_consumables')
            ->where('employee_id', $employeeId)
            ->where('drink_consumable_id', $drinkConsumableId)
            ->where('paid', false)
            ->update(['paid' => true]);

        if ($affectedRows > 0) {
            return back()->with('success', 'Drink marked as paid successfully.');
        } else {
            return back()->with('error', 'No unpaid drinks found for this employee.');
        }
    }

     public function allEmployeeConsumables()
    {
        // Fetch all employees and their associated drink consumables
        // Make sure the relationships are correctly defined in the Employee model
        $employees = Employee::with(['drinkConsumables'])->get();

        // Pass the data to the view
        return view('receptionist.drink-consumables.all-employees-drink-consumables', compact('employees'));
    }
}
