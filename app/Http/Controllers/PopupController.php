<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PopupController extends Controller
{
    public function indexPopupAdmin()
    {
        $popups = Popup::latest()->get(); // urutkan dari yang terbaru ke yang lama
        return view('admin.popup.index', compact('popups'));
    }


    public function storePopupAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'media_popup' => 'required|mimes:jpeg,png,jpg,mp4|max:10240', // max 10MB
            'display_type' => 'required|in:popup,slider,both',
        ], [
            'name.required' => 'Nama pop-up wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'media_popup.required' => 'File wajib dipilih',
            'media_popup.mimes' => 'Format harus JPG, PNG, JPEG, atau MP4',
            'media_popup.max' => 'Ukuran maksimal 10MB',
            'display_type.required' => 'Pilih tipe tampilan',
        ]);

        $mediaPath = null;
        $mediaType = 'image';

        try {
            if ($request->hasFile('media_popup')) {
                $file = $request->file('media_popup');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $mediaPath = $file->storeAs('popup_media', $fileName, 'public');

                // Cek tipe file
                $extension = $file->getClientOriginalExtension();
                if (in_array($extension, ['mp4'])) {
                    $mediaType = 'video';
                }
            }

            $popup = new \App\Models\Popup();
            $popup->name = $validatedData['name'];
            $popup->description = $validatedData['description'];
            $popup->media_popup = $mediaPath;
            $popup->media_type = $mediaType;
            $popup->display_type = $validatedData['display_type'];
            $popup->is_active = true;
            $popup->save();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $popup
            ], 200);
        } catch (\Throwable $e) {
            if ($mediaPath && Storage::disk('public')->exists($mediaPath)) {
                Storage::disk('public')->delete($mediaPath);
            }
            Log::error('Gagal menyimpan popup', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.'
            ], 500);
        }
    }


    public function show($id)
    {
        $popup = Popup::findOrFail($id);

        return response()->json([
            'id'          => $popup->id,
            'name'        => $popup->name,
            'description' => $popup->description,
            'media_popup' => $popup->media_popup ? asset('storage/' . $popup->media_popup) : null,
            'media_type'  => $popup->media_type,
            'display_type' => $popup->display_type,
            'is_active'   => $popup->is_active,
            'created_at'  => $popup->created_at->translatedFormat('d F Y')
        ]);
    }


    public function toggle($id)
    {
        $popup = \App\Models\Popup::findOrFail($id);

        $popup->is_active = !$popup->is_active;
        $popup->save();

        return response()->json([
            'success' => true,
            'is_active' => $popup->is_active,
            'message' => $popup->is_active ? 'Popup diaktifkan' : 'Popup dinonaktifkan'
        ]);
    }
    public function destroy($id)
    {
        try {
            $popup = Popup::find($id);

            if (!$popup) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data popup tidak ditemukan.'
                ], 404);
            }

            // Jika ada file media, hapus dari storage
            if ($popup->media_popup && Storage::disk('public')->exists($popup->media_popup)) {
                Storage::disk('public')->delete($popup->media_popup);
            }

            // Hapus record popup dari database
            $popup->delete();

            return response()->json([
                'success' => true,
                'message' => 'Popup berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus popup: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data popup.'
            ], 500);
        }
    }
}