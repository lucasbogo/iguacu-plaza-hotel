<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeDrinkConsumable;
use App\Models\DrinkConsumable;
use App\Models\CashierClosingRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeDrinkConsumableController extends Controller
{
    public function index()
    {
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

        return redirect()->route('receptionist.employee-drink-consumables.index')->with('success', 'Bebida (funcionário_ criada com sucesso.');
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
            return back()->with('error', 'Quantidade em estoque não disponível.');
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

        return back()->with('success', 'Bebida (funcionário) comprado com sucesso.');
    }

    public function markAsPaid(Request $request, $employeeId, $drinkConsumableId)
    {
        DB::transaction(function () use ($employeeId, $drinkConsumableId) {
            // Retrieve all unpaid drinks for this employee and drink combination
            $employeeDrinks = EmployeeDrinkConsumable::where('employee_id', $employeeId)
                ->where('drink_consumable_id', $drinkConsumableId)
                ->where('paid', false)
                ->get();

            if ($employeeDrinks->isEmpty()) {
                return back()->with('error', 'No unpaid drinks found for this employee.');
            }

            $totalPaidAmount = 0;
            foreach ($employeeDrinks as $employeeDrink) {
                // Calculate the total amount based on employee_price and update it
                $totalPaidAmount += $employeeDrink->quantity * $employeeDrink->employee_price;

                // Mark the drink as paid
                $employeeDrink->paid = true;
                $employeeDrink->save();
            }

            // Update the CashierClosingRecord
            $currentClosingRecord = CashierClosingRecord::where([
                'receptionist_id' => Auth::id(),
                'closed_at' => null,
            ])->latest()->first();

            if (!$currentClosingRecord) {
                // Handle the case where there's no open Cashier Closing Record, if necessary
                $currentClosingRecord = CashierClosingRecord::create([
                    'receptionist_id' => Auth::id(),
                    'closed_at' => null,
                    'start_amount' => 0,
                    'end_amount' => 0, // Set default end amount if needed
                    'total_sales' => 0,
                    'total_cash_received' => 0,
                    'rental_income' => 0,
                    'drink_income' => $totalPaidAmount,
                    'room_service_income' => 0,
                    'created_at' => now(), // Ensure correct timestamp, or adjust as necessary
                    'updated_at' => now(),
                ]);
            } else {
                // Increment the drink_income with the total paid amount for employee drinks
                $currentClosingRecord->increment('drink_income', $totalPaidAmount);
            }
        });

        return back()->with('success', 'Bebida marca como "pago" com sucesso e valor atribuído ao caixa atual.');
    }

    public function allEmployeeConsumables()
    {
        // Fetch all employees and their associated drink consumables
        $employees = Employee::with(['drinkConsumables'])->get();

        // Pass the data to the view
        return view('receptionist.drink-consumables.all-employees-drink-consumables', compact('employees'));
    }
}
