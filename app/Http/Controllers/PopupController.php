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
        $popups = Popup::all();
        return view('admin.popup.index', compact('popups'));
    }

    public function storePopupAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_popup' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.required' => 'Nama pop-up wajib diisi',
            'name.max' => 'Nama pop-up maksimal 255 karakter',
            'description.required' => 'Deskripsi wajib diisi',
            'image_popup.required' => 'Gambar pop-up wajib dipilih',
            'image_popup.image' => 'File harus berupa gambar',
            'image_popup.mimes' => 'Format gambar harus JPG, PNG, atau JPEG',
            'image_popup.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $imagePath = null;

        try {
            // Proses upload gambar
            if ($request->hasFile('image_popup')) {
                $image = $request->file('image_popup');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('popup_images', $imageName, 'public');
            }

            // Simpan data ke database
            $popup = new \App\Models\Popup();
            $popup->name = $validatedData['name'];
            $popup->description = $validatedData['description'];
            $popup->image_popup = $imagePath;
            $popup->is_active = true; // 👉 default active
            $popup->save();


            return response()->json([
                'success' => true,
                'message' => 'Pop-up berhasil disimpan!',
                'data' => $popup
            ], 200);
        } catch (\Throwable $e) {
            // Jika gagal upload / simpan → hapus file yg sudah terupload
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            // log error lengkap
            Log::error('Gagal menyimpan popup', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data. Silakan cek log untuk detail.'
            ], 500);
        }
    }

    public function show($id)
    {
        $popup = Popup::findOrFail($id);

        return response()->json([
            'name' => $popup->name,
            'description' => $popup->description,
            'image_popup' => $popup->image_popup ? asset('storage/' . $popup->image_popup) : null,
            'created_at' => $popup->created_at->translatedFormat('d F Y')
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
        $popup = Popup::findOrFail($id);

        // jika ada file gambar, hapus dari storage
        if ($popup->image_popup && \Storage::disk('public')->exists($popup->image_popup)) {
            \Storage::disk('public')->delete($popup->image_popup);
        }

        $popup->delete();

        return response()->json(['success' => true, 'message' => 'Popup deleted successfully!']);
    }
}
