<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class AdminPageController extends Controller
{
    public function about()
    {
        $page = Page::where('id', 1)->first();
        return view('admin.page.about', compact('page'));
    }

    public function about_update(Request $request)
    {
        $page = Page::where('id', 1)->first();
        $page->about_heading = $request->about_heading;
        $page->about_content = $request->about_content;
        $page->about_status = $request->about_status;
        $page->update();

        return redirect()->back()->with('success', 'Página "Sobre o Hotel" atualizada com sucesso!');
    }
}
