<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer;


class ProfileController extends Controller
{
    public function profile()
    {
        return view('customer.profile');
    }

    public function profile_submit(Request $request)
    {
        $customer = Customer::where('email', Auth::guard('customer')->user()->email)->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        if ($request->password != '') {
            $request->validate([
                'password' => 'required',
                'retype_password' => 'required|same:password'
            ]);
            $customer->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            if ($customer->photo != NULL) {
                unlink(public_path('uploads/' . $customer->photo));
            }

            $ext = $request->file('photo')->extension();
            $final_name = time() . '.' . $ext;
            $request->file('photo')->move(public_path('uploads/'), $final_name);

            $customer->photo = $final_name;
        }


        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->country = $request->country;
        $customer->street = $request->street;
        $customer->number = $request->number;
        $customer->state = $request->state;
        $customer->city = $request->city;
        $customer->zip_code = $request->zip_code;
        $customer->update();

        return redirect()->back()->with('success', 'Perfil Editado com Sucesso!');
    }
}
