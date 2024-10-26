<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contactus;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsResponseMail;
use Illuminate\Support\Facades\Log;

class ContactusController extends Controller
{
    public function indexContactusAdmin()
    {

        $contacts = Question::paginate(8);

        return view('admin.contactus.index', compact('contacts'));
    }

    
    public function show($id)
    {
        $contact = Question::findOrFail($id);
        return view('admin.contactus.show', compact('contact'));
    }

    public function sendResponse(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|min:10'
        ]);

        $contact = Question::findOrFail($id);

        try {
            Log::info('Attempting to send email to: ' . $contact->email);

            Mail::to($contact->email)
                ->send(new ContactUsResponseMail($contact, $request->response));

            Log::info('Email sent successfully to: ' . $contact->email);

            $contact->update([
                'response' => $request->response,
                'responded_at' => now()
            ]);

            return redirect()->route('index-contactus-admin')
                ->with('toast_success', 'Response has been sent successfully!');
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
