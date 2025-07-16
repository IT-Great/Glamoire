<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contactus;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsResponseMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ContactusController extends Controller
{
    public function indexContactusAdmin(Request $request)
    {
        // Ambil nilai dari input pencarian
        $search = $request->input('search');
        $date = $request->input('date_expired');

        // Query dasar untuk mendapatkan data dari tabel Question
        $contacts = Question::query();

        // Jika ada input pencarian, tambahkan kondisi filter
        if ($search) {
            $contacts = $contacts->where(function ($query) use ($search) {
                $query->where('fullname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Jika ada input tanggal, tambahkan kondisi filter untuk tanggal
        if ($date) {
            $contacts = $contacts->whereDate('created_at', $date);
        }

        // Urutkan data berdasarkan created_at secara descending dan paginasi
        $contacts = $contacts->orderBy('created_at', 'desc')->paginate(10);

        // Kembalikan view dengan data yang sudah difilter
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
            'response' => 'required|min:10',
            'response_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'response_video' => 'nullable|mimes:mp4,mov,avi|max:10240',
        ]);

        $contact = Question::findOrFail($id);

        try {
            $data = [
                'response' => $request->response,
                'responded_at' => now(),
                'status' => 'read', // Ubah status menjadi read
            ];

            // Handle image upload
            if ($request->hasFile('response_image')) {
                $image = $request->file('response_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('contact_us/images', $imageName, 'public');
                $data['response_image'] = $imagePath; // Simpan path gambar ke field response_image
            }

            // Handle video upload
            if ($request->hasFile('response_video')) {
                $video = $request->file('response_video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $videoPath = $video->storeAs('contact_us/videos', $videoName, 'public');
                $data['response_video'] = $videoPath; // Simpan path video ke field response_video
            }

            // Update the record
            $contact->update($data);

            // Send email
            Mail::to($contact->email)
                ->send(new ContactUsResponseMail($contact));

            return redirect()->route('index-contactus-admin')
                ->with('success', 'Response has been sent successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to send response: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('toast_error', 'Failed to send response: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function deleteResponse($id)
    {
        $contact = Question::findOrFail($id);

        try {
            // Hapus gambar jika ada
            if ($contact->response_image && Storage::disk('public')->exists($contact->response_image)) {
                Storage::disk('public')->delete($contact->response_image);
            }

            // Hapus video jika ada
            if ($contact->response_video && Storage::disk('public')->exists($contact->response_video)) {
                Storage::disk('public')->delete($contact->response_video);
            }

            // Hapus data contact
            $contact->delete();

            return response()->json(['success' => true, 'message' => 'Contact has been deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Failed to delete response: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to delete response!']);
        }
    }


    public function getUnreadQuestionsCount(Request $request)
    {
        try {
            $unreadQuestions = Question::whereNull('response')
                ->whereNull('responded_at')
                ->count();

            // Kalau browser minta HTML, jangan kirim JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'unreadQuestions' => $unreadQuestions
                ]);
            } else {
                return response("Unread questions: $unreadQuestions", 200)
                    ->header('Content-Type', 'text/plain');
            }
        } catch (\Exception $e) {
            Log::error('Error in getUnreadQuestionsCount: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Failed to fetch unread count'
                ], 500);
            } else {
                return response("Error: Failed to fetch unread count", 500)
                    ->header('Content-Type', 'text/plain');
            }
        }
    }
}
