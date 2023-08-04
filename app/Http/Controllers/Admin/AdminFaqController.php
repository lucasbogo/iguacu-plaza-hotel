<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::get();
        return view('admin.faq.faq_view', compact('faqs'));
    }

    public function add()
    {
        return view('admin.faq.faq_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('admin_faq')->with('success', 'FAQ Adicionado com Sucesso!');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.faq_edit', compact('faq'));
    }


    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $request->validate([
            'question' => 'sometimes|required',
            'answer' => 'sometimes|required',
        ]);

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('admin_faq')->with('success', 'FAQ Atualizado com Sucesso!');
    }

    public function activate($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->status = !$faq->status; // Toggle the status (if it's 1, make it 0, and vice versa)
        $faq->save();

        return redirect()->route('admin_faq')->with('success', 'Pergunta Ativada/Desativada com Sucesso!');
    }


    public function delete($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin_faq')->with('success', 'FAQ Deletado com Sucesso!');
    }
}
