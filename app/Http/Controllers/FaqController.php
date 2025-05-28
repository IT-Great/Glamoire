<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // halaman user
    public function index()
    {
        $faqsByCategory = Faq::all()->groupBy('category');
        return view('user.component.help', compact('faqsByCategory'));
    }


    // halaman admin
    public function indexFaqAdmin()
    {
        $faqs = Faq::all();
        $faqsByCategory = $faqs->groupBy('category');
        $totalFaq = $faqs->count();
        $totalCategory = $faqs->pluck('category')->unique()->count();

        return view('admin.faq.index', compact('faqsByCategory', 'totalFaq', 'totalCategory', 'faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = Faq::create($request->all());

        return response()->json([
            'success' => 'FAQ added successfully!',
            'data' => $faq
        ]);
    }

    public function delete($id)
    {
        Faq::findOrFail($id)->delete();
        return response()->json(['success' => 'FAQ deleted successfully']);
    }

    public function renderRow(Faq $faq)
    {
        return view('faqs.partials.row', compact('faq'))->render();
    }
}
