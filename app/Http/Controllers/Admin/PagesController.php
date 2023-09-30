<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PagesController extends Controller
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

    public function image_gallery()
    {
        $page = Page::where('id', 1)->first();
        return view('admin.pages.image_gallery', compact('page'));
    }

    public function image_gallery_update(Request $request)
    {
        $page = Page::where('id', 1)->first();
        $page->image_gallery_heading = $request->image_gallery_heading;
        $page->image_gallery_status = $request->image_gallery_status;
        $page->update();

        return redirect()->back()->with('success', 'Página "Galeria de Imagens" atualizada com sucesso!');
    }

    public function video_gallery()
    {
        $page = Page::where('id', 1)->first();
        return view('admin.pages.video_gallery', compact('page'));
    }

    public function video_gallery_update(Request $request)
    {
        $page = Page::where('id', 1)->first();
        $page->video_gallery_heading = $request->video_gallery_heading;
        $page->video_gallery_status = $request->video_gallery_status;
        $page->update();

        return redirect()->back()->with('success', 'Página "Galeria de Vídeos" atualizada com sucesso!');
    }

    public function faq()
    {
        $page = Page::where('id', 1)->first();
        return view('admin.pages.faq', compact('page'));
    }

    public function faq_update(Request $request)
    {
        $page = Page::where('id', 1)->first();
        $page->faq_heading = $request->faq_heading;
        $page->faq_status = $request->faq_status;
        $page->update();

        return redirect()->back()->with('success', 'Página "Perguntas Frequentes" atualizada com sucesso!');
    }

    public function blog()
    {
        $page = Page::where('id', 1)->first();
        return view('admin.pages.blog', compact('page'));
    }

    public function blog_update(Request $request)
    {
        $page = Page::where('id', 1)->first();
        $page->blog_heading = $request->blog_heading;
        $page->blog_status = $request->blog_status;
        $page->update();

        return redirect()->back()->with('success', 'Página "Blog" atualizada com sucesso!');
    }

    public function contact()
    {
        $page = Page::where('id', 1)->first();
        return view('admin.pages.contact', compact('page'));
    }

    public function contact_update(Request $request)
    {
        $page = Page::where('id', 1)->first();
        $page->contact_heading = $request->contact_heading;
        $page->contact_map = $request->contact_map;
        $page->contact_status = $request->contact_status;
        $page->update();

        return redirect()->back()->with('success', 'Página "Contato" atualizada com sucesso!');
    }

    public function cart()
    {
        $page = Page::where('id', 1)->first();
        return view('admin.pages.cart', compact('page'));
    }

    public function cart_update(Request $request)
    {
        $page = Page::where('id', 1)->first();
        $page->cart_heading = $request->cart_heading;
        $page->cart_status = $request->cart_status;
        $page->update();

        return redirect()->back()->with('success', 'Página "Carrinho" atualizada com sucesso!');
    }

    public function checkout()
    {
        $page = Page::where('id', 1)->first();
        return view('admin.pages.checkout', compact('page'));
    }

    public function checkout_update(Request $request)
    {
        $page = Page::where('id', 1)->first();
        $page->checkout_heading = $request->checkout_heading;
        $page->checkout_status = $request->checkout_status;
        $page->update();    

        return redirect()->back()->with('success', 'Página "Checkout" atualizada com sucesso!');
    }

    public function payment()
    {
        $page = Page::where('id', 1)->first();
        return view('admin.pages.payment', compact('page'));
    }

    public function payment_update(Request $request)
    {
        $page = Page::where('id', 1)->first();
        $page->payment_heading = $request->payment_heading;
        $page->payment_status = $request->payment_status;
        $page->update();

        return redirect()->back()->with('success','Página "Pagamento" atualizada com sucesso!');
    }
}



