<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contactus;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsResponseMail;
use Illuminate\Support\Facades\Log;

// class ContactusController extends Controller
// {
//     public function indexContactusAdmin(Request $request)
//     {
//         // Ambil nilai dari input pencarian
//         $search = $request->input('search');
//         $date = $request->input('date_expired');

//         // Query dasar untuk mendapatkan data dari tabel Question
//         $contacts = Question::query();

//         // Jika ada input pencarian, tambahkan kondisi filter
//         if ($search) {
//             $contacts = $contacts->where(function ($query) use ($search) {
//                 $query->where('fullname', 'like', "%{$search}%")
//                     ->orWhere('email', 'like', "%{$search}%");
//             });
//         }

//         // Jika ada input tanggal, tambahkan kondisi filter untuk tanggal
//         if ($date) {
//             $contacts = $contacts->whereDate('created_at', $date);
//         }

//         // Urutkan data berdasarkan created_at secara descending dan paginasi
//         $contacts = $contacts->orderBy('created_at', 'desc')->paginate(10);

//         // Kembalikan view dengan data yang sudah difilter
//         return view('admin.contactus.index', compact('contacts'));
//     }



//     public function show($id)
//     {
//         $contact = Question::findOrFail($id);
//         return view('admin.contactus.show', compact('contact'));
//     }

//     public function sendResponse(Request $request, $id)
//     {
//         $request->validate([
//             'response' => 'required|min:10',
//             'response_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//             'response_video' => 'nullable|mimes:mp4,mov,avi|max:10240'
//         ]);

//         $contact = Question::findOrFail($id);

//         try {
//             $data = [
//                 'response' => $request->response,
//                 'responded_at' => now()
//             ];

//             // Handle image upload
//             if ($request->hasFile('response_image')) {
//                 $image = $request->file('response_image');
//                 $imageName = time() . '_' . $image->getClientOriginalName();
//                 // Simpan file ke storage/app/public/contact_us/images
//                 $imagePath = $image->storeAs('contact_us/images', $imageName, 'public');
//                 $data['response_image'] = $imagePath;
//             }

//             // Handle video upload
//             if ($request->hasFile('response_video')) {
//                 $video = $request->file('response_video');
//                 $videoName = time() . '_' . $video->getClientOriginalName();
//                 // Simpan file ke storage/app/public/contact_us/videos
//                 $videoPath = $video->storeAs('contact_us/videos', $videoName, 'public');
//                 $data['response_video'] = $videoPath;
//             }

//             // Update contact with response and media paths
//             $contact->update($data);

//             // Send email with media attachments
//             Mail::to($contact->email)
//                 ->send(new ContactUsResponseMail($contact));

//             Log::info('Response sent successfully to: ' . $contact->email);
//             return redirect()->route('index-contactus-admin')
//                 ->with('toast_success', 'Response has been sent successfully!');
//         } catch (\Exception $e) {
//             Log::error('Failed to send response: ' . $e->getMessage());
//             Log::error($e->getTraceAsString());
//             return redirect()
//                 ->back()
//                 ->with('toast_error', 'Failed to send response: ' . $e->getMessage())
//                 ->withInput();
//         }
//     }
// }

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


    // public function sendResponse(Request $request, $id)
    // {
    //     $request->validate([
    //         'response' => 'required|min:10',
    //         'response_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'response_video' => 'nullable|mimes:mp4,mov,avi|max:10240'
    //     ]);

    //     $contact = Question::findOrFail($id);

    //     try {
    //         $data = [
    //             'response' => $request->response,
    //             'responded_at' => now() // Ini akan mengupdate status pesan
    //         ];

    //         // Handle image upload
    //         if ($request->hasFile('response_image')) {
    //             $image = $request->file('response_image');
    //             $imageName = time() . '_' . $image->getClientOriginalName();
    //             $imagePath = $image->storeAs('contact_us/images', $imageName, 'public');
    //             $data['response_image'] = $imagePath;

    //             Log::info('Image uploaded to: ' . $imagePath);
    //         }

    //         // Handle video upload
    //         if ($request->hasFile('response_video')) {
    //             $video = $request->file('response_video');
    //             $videoName = time() . '_' . $video->getClientOriginalName();
    //             $videoPath = $video->storeAs('contact_us/videos', $videoName, 'public');
    //             $data['response_video'] = $videoPath;

    //             Log::info('Video uploaded to: ' . $videoPath);
    //         }
    //         // Update contact with response and media paths
    //         $contact->update($data);

    //         // Send email with media attachments
    //         Mail::to($contact->email)
    //             ->send(new ContactUsResponseMail($contact));

    //         Log::info('Response sent successfully to: ' . $contact->email);


    //         return redirect()->route('index-contactus-admin')
    //             ->with('toast_success', 'Response has been sent successfully!');
    //     } catch (\Exception $e) {
    //         Log::error('Failed to send response: ' . $e->getMessage());
    //         Log::error($e->getTraceAsString());
    //         return redirect()
    //             ->back()
    //             ->with('toast_error', 'Failed to send response: ' . $e->getMessage())
    //             ->withInput();
    //     }
    // }

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
                $data['image'] = $imagePath;
            }

            // Handle video upload
            if ($request->hasFile('response_video')) {
                $video = $request->file('response_video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $videoPath = $video->storeAs('contact_us/videos', $videoName, 'public');
                $data['video'] = $videoPath;
            }

            // Update the record
            $contact->update($data);

            // Send email
            Mail::to($contact->email)
                ->send(new ContactUsResponseMail($contact));

            return redirect()->route('index-contactus-admin')
                ->with('toast_success', 'Response has been sent successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to send response: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('toast_error', 'Failed to send response: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function getUnreadQuestionsCount()
    {
        try {
            // Hitung pesan yang belum direspon
            $unreadQuestions = Question::whereNull('response')
                ->whereNull('responded_at')
                ->count();

            return response()->json([
                'success' => true,
                'unreadQuestions' => $unreadQuestions
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getUnreadQuestionsCount: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch unread count'
            ], 500);
        }
    }
}
