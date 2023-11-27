<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('id', 1)->first();
        return view('admin.settings.setting', compact('settings'));
    }

    public function update(Request $request)
    {

        $obj = Setting::where('id', 1)->first();

        // Check if logo file exists in the request
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            // Check if the old logo file exists before attempting to unlink
            if (file_exists(public_path('uploads/' . $obj->logo))) {
                unlink(public_path('uploads/' . $obj->logo));
            }

            $ext = $request->file('logo')->extension();
            $final_name = time() . '.' . $ext;
            $request->file('logo')->move(public_path('uploads/'), $final_name);
            $obj->logo = $final_name;
        }

        // Check if favicon file exists in the request
        if ($request->hasFile('favicon')) {
            $request->validate([
                'favicon' => 'image|mimes:jpg,jpeg,png,gif,ico'
            ]);

            // Check if the old favicon file exists before attempting to unlink
            if (file_exists(public_path('uploads/' . $obj->favicon))) {
                unlink(public_path('uploads/' . $obj->favicon));
            }

            $ext = $request->file('favicon')->extension();
            $final_name = time() . '.' . $ext;
            $request->file('favicon')->move(public_path('uploads/'), $final_name);
            $obj->favicon = $final_name;
        }

        $obj->top_bar_whatsapp = $request->top_bar_whatsapp;
        $obj->top_bar_whatsapp_link = $request->top_bar_whatsapp_link;
        $obj->top_bar_phone = $request->top_bar_phone;
        $obj->top_bar_email = $request->top_bar_email;
        $obj->footer_hotel_title = $request->footer_hotel_title;
        $obj->footer_address = $request->footer_address;
        $obj->footer_hotel_whatsapp = $request->footer_hotel_whatsapp;
        $obj->footer_hotel_whatsapp_link = $request->footer_hotel_whatsapp_link;
        $obj->footer_phone = $request->footer_phone;
        $obj->footer_email = $request->footer_email;
        $obj->copyright = $request->copyright;
        $obj->facebook = $request->facebook;
        $obj->twitter = $request->twitter;
        $obj->linkedin = $request->linkedin;
        $obj->pinterest = $request->pinterest;
        $obj->analytic_id = $request->analytic_id;
        $obj->theme_color_1 = $request->theme_color_1;
        $obj->theme_color_2 = $request->theme_color_2;
        $obj->update();

        return redirect()->back()->with('success', 'Setting is updated successfully.');
    }
}
