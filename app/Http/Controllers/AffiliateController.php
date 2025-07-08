<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\AffiliateResponseMail;
use App\Models\Partner;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AffiliateController extends Controller
{
    public function indexAffiliateAdmin()
    {
        $partners = Partner::orderBy('created_at', 'desc')->get();

        return view('admin.affiliate.index', compact('partners'));
    }

    public function detailAffiliateAdmin($id)
    {
        // $partners = Partner::findorFail($id);
        $partners = Partner::with(['fileCompany', 'fileBpom'])->find($id);

        return view('admin.affiliate.detail', compact('partners'));
    }

    public function sendResponseAffiliate(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|min:10'
        ]);

        $partners = Partner::findOrFail($id);

        try {
            Log::info('Attempting to send email to: ' . $partners->email);

            Mail::to($partners->email)
                ->send(new AffiliateResponseMail($partners, $request->response));

            Log::info('Email sent successfully to: ' . $partners->email);

            $partners->update([
                'response' => $request->response,
                'responded_at' => now()
            ]);

            return redirect()->route('index-affiliate-admin')
                ->with('success', 'Response has been sent successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()
                ->back()
                ->with('toast_error', 'Failed to send response: ' . $e->getMessage())
                ->withInput();
        }
    }
}
