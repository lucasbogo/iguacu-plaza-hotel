<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::get();
        $customerCount = $customers->count();

        // If there are no customers, set a default value
        if ($customerCount === 0) {
            $customerCount = 0;
        }

        return view('admin.customer.customer', compact('customerCount'));
    }

    public function change_status($id)
    {
        $customerData = Customer::where('id', $id)->first();

        if ($customerData->status == 1) {
            $customerData->status = 0;
        } else {
            $customerData->status = 1;
        }

        $customerData->update();

        return redirect()->back()->with('success', 'Status do cliente alterado com sucesso!');
    }
}
