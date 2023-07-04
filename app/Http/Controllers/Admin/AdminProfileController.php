<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin as AdminModel;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function update(Request $request)
    {
        $admin = AdminModel::where('email', Auth::guard('admin')->user()->email)->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($request->password != null) {
            $request->validate([
                'password' => 'required',
                'retype_password' => 'required|same:password',
            ]);

            $admin->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($admin->photo) {
                $photoPath = public_path('uploads/' . $admin->photo);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }

            $extension = $request->file('photo')->extension();
            $final_name = 'admin' . '.' . $extension;

            $request->file('photo')->move(public_path('uploads'), $final_name);

            $admin->photo = $final_name;
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->update();

        return redirect()->back()->with('success', 'Perfil editado com sucesso.');
    }
}
