<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function indexFaqAdmin()
    {
        // Group FAQs by category
        $faqs = Faq::all()->groupBy('category');
        return view('admin.faq.index', compact('faqs'));
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
