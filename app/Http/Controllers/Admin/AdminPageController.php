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
        return view('admin.pages.about', compact('page'));
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

    public function terms()
    {
        $page = Page::where('id', 1)->first();
        return view('admin.pages.terms', compact('page'));
    }

    public function terms_update(Request $request)
    {
        $page = Page::where('id', 1)->first();
        $page->terms_heading = $request->terms_heading;
        $page->terms_content = $request->terms_content;
        $page->terms_status = $request->terms_status;
        $page->update();

        return redirect()->back()->with('success', 'Página "Termos e Condições" atualizada com sucesso!');
    }

    public function privacy()
    {
        $page = Page::where('id', 1)->first();
        return view('admin.pages.privacy', compact('page'));
    }

    public function privacy_update(Request $request)
    {
        $page = Page::where('id', 1)->first();
        $page->privacy_heading = $request->privacy_heading;
        $page->privacy_content = $request->privacy_content;
        $page->privacy_status = $request->privacy_status;
        $page->update();

        return redirect()->back()->with('success', 'Página "Política de Privacidade" atualizada com sucesso!');
    }
}
