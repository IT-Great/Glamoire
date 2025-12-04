<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PgSql\Lob;

class AboutusController extends Controller
{

    public function indexAboutusAdmin()
    {
        $aboutUs = AboutUs::first();

        return view('admin.aboutus.index', compact('aboutUs'));
    }


    public function createAboutusAdmin()
    {
        // cek kalau sudah ada data, redirect ke edit
        $aboutUs = AboutUs::first();
        if ($aboutUs) {
            return redirect()->route('edit-aboutus-admin', $aboutUs->id);
        }

        return view('admin.aboutus.create');
    }


    public function storeAboutusAdmin(Request $request)
    {
        // Log semua request data untuk debugging
        Log::info('=== START CREATE ABOUT US ===');
        Log::info('Request Data:', $request->all());
        Log::info('Files:', $request->allFiles());

        try {
            // Validasi
            Log::info('Memulai validasi...');

            $validated = $request->validate([
                'hero_title' => 'required|string|max:255',
                'hero_description' => 'nullable|string',
                'hero_image' => 'nullable|image|max:2048',

                'intro_title' => 'nullable|string|max:255',
                'intro_description' => 'nullable|string',
                'intro_image' => 'nullable|image|max:2048',
                'intro_video' => 'nullable|file|mimes:mp4,mov,avi,wmv,gif|max:102400',

                'vision_title' => 'nullable|string|max:255',
                'vision_description' => 'nullable|string',
                'vision_image' => 'nullable|image|max:2048',
                'vision_video' => 'nullable|file|mimes:mp4,mov,avi,wmv,gif|max:102400',

                'mission_title' => 'nullable|string|max:255',
                'mission_description' => 'nullable|string',
                'mission_image' => 'nullable|image|max:2048',
                'mission_video' => 'nullable|file|mimes:mp4,mov,avi,wmv,gif|max:102400',

                'story_title' => 'nullable|string|max:255',
                'story_description' => 'nullable|string',
                'story_image' => 'nullable|image|max:2048',
                'story_video' => 'nullable|file|mimes:mp4,mov,avi,wmv,gif|max:102400',

                'achievement_title' => 'nullable|string|max:255',
                'achievement_description' => 'nullable|string',
                'achievement_image' => 'nullable|image|max:2048',
                'achievement_video' => 'nullable|file|mimes:mp4,mov,avi,wmv,gif|max:102400',
            ]);

            Log::info('Validasi berhasil!');
            Log::info('Validated Data:', $validated);

            // Proses upload file
            Log::info('Memulai proses upload file...');

            foreach (['hero', 'intro', 'vision', 'mission', 'story', 'achievement'] as $section) {
                // Upload image
                $imageField = "{$section}_image";
                if ($request->hasFile($imageField)) {
                    Log::info("Mengupload {$imageField}...");
                    $file = $request->file($imageField);
                    Log::info("File {$imageField} info:", [
                        'name' => $file->getClientOriginalName(),
                        'size' => $file->getSize(),
                        'mime' => $file->getMimeType(),
                    ]);

                    $validated[$imageField] = $file->store('aboutus/images', 'public');
                    Log::info("{$imageField} berhasil diupload ke: {$validated[$imageField]}");
                }

                // Upload video/gif
                $videoField = "{$section}_video";
                if ($request->hasFile($videoField)) {
                    Log::info("Mengupload {$videoField}...");
                    $file = $request->file($videoField);
                    Log::info("File {$videoField} info:", [
                        'name' => $file->getClientOriginalName(),
                        'size' => $file->getSize(),
                        'mime' => $file->getMimeType(),
                    ]);

                    $validated[$videoField] = $file->store('aboutus/videos', 'public');
                    Log::info("{$videoField} berhasil diupload ke: {$validated[$videoField]}");
                }
            }

            Log::info('Semua file berhasil diupload!');
            Log::info('Data yang akan disimpan ke database:', $validated);

            // Simpan ke database
            Log::info('Menyimpan data ke database...');
            $aboutUs = AboutUs::create($validated);

            Log::info('Data berhasil disimpan ke database!');
            Log::info('About Us ID:', ['id' => $aboutUs->id]);
            Log::info('=== END CREATE ABOUT US (SUCCESS) ===');

            return redirect()->route('index-aboutus-admin')
                ->with('success', 'About Us created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('=== VALIDATION ERROR ===');
            Log::error('Validation failed:', [
                'errors' => $e->errors(),
                'message' => $e->getMessage(),
            ]);
            Log::error('=== END CREATE ABOUT US (VALIDATION FAILED) ===');

            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Validasi gagal! Periksa kembali form Anda.');
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('=== DATABASE ERROR ===');
            Log::error('Database error:', [
                'message' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings(),
            ]);
            Log::error('=== END CREATE ABOUT US (DATABASE ERROR) ===');

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan database: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('=== GENERAL ERROR ===');
            Log::error('General exception:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            Log::error('=== END CREATE ABOUT US (GENERAL ERROR) ===');

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function editAboutusAdmin($id)
    {
        $aboutUs = AboutUs::findOrFail($id);

        return view('admin.aboutus.edit', compact('aboutUs'));
    }

    public function updateAboutusAdmin(Request $request, $id)
    {
        $aboutUs = AboutUs::findOrFail($id);

        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|max:2048',

            'intro_title' => 'nullable|string|max:255',
            'intro_description' => 'nullable|string',
            'intro_image' => 'nullable|image|max:2048',
            'intro_video' => 'nullable|mimes:mp4,mov,avi,wmv,gif|max:10200',

            'vision_title' => 'nullable|string|max:255',
            'vision_description' => 'nullable|string',
            'vision_image' => 'nullable|image|max:2048',
            'vision_video' => 'nullable|mimes:mp4,mov,avi,wmv,gif|max:10200',


            'mission_title' => 'nullable|string|max:255',
            'mission_description' => 'nullable|string',
            'mission_image' => 'nullable|image|max:2048',
            'mission_video' => 'nullable|mimes:mp4,mov,avi,wmv,gif|max:10200',

            'story_title' => 'nullable|string|max:255',
            'story_description' => 'nullable|string',
            'story_image' => 'nullable|image|max:2048',
            'story_video' => 'nullable|mimes:mp4,mov,avi,wmv,gif|max:10200',


            'achievement_title' => 'nullable|string|max:255',
            'achievement_description' => 'nullable|string',
            'achievement_image' => 'nullable|image|max:2048',
            'achievement_video' => 'nullable|mimes:mp4,mov,avi,wmv,gif|max:10200',

        ]);

        // proses upload file untuk semua gambar
        foreach (['hero', 'intro', 'vision', 'mission', 'story', 'achievement'] as $section) {
            $imageField = "{$section}_image";
            if ($request->hasFile($imageField)) {
                // Hapus gambar lama jika ada
                if ($aboutUs->$imageField) {
                    Storage::disk('public')->delete($aboutUs->$imageField);
                }
                $validated[$imageField] = $request->file($imageField)->store('aboutus', 'public');
            }

            // proses upload video
            $videoField = "{$section}_video";
            if ($request->hasFile($videoField)) {
                // Hapus video lama jika ada
                if ($aboutUs->$videoField) {
                    Storage::disk('public')->delete($aboutUs->$videoField);
                }
                $validated[$videoField] = $request->file($videoField)->store('aboutus/videos', 'public');
            }
        }

        $aboutUs->update($validated);

        return redirect()->route('index-aboutus-admin')->with('success', 'About Us updated successfully!');
    }

    public function deleteAboutUsField(Request $request)
    {
        $request->validate([
            'field' => 'required|string'
        ]);

        $aboutUs = AboutUs::first();

        if (!$aboutUs) {
            return response()->json([
                'success' => false,
                'message' => 'Data About Us tidak ditemukan'
            ], 404);
        }

        $field = $request->field;

        // Jika field adalah image atau video, hapus file dari storage
        if ((str_contains($field, '_image') || str_contains($field, '_video')) && $aboutUs->$field) {
            if (Storage::disk('public')->exists($aboutUs->$field)) {
                Storage::disk('public')->delete($aboutUs->$field);
            }
        }

        // Set field menjadi null
        $aboutUs->$field = null;
        $aboutUs->save();

        return response()->json([
            'success' => true,
            'message' => 'Field berhasil dihapus'
        ]);
    }
}
