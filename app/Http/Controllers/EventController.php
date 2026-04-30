<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class EventController extends Controller
{
    // ==========================================
    // SISI ADMIN (MANAJEMEN CRUD)
    // ==========================================

    public function indexAdmin()
    {
        $events = Event::latest()->get();
        return view('admin.event.index', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date'  => 'required|date',
            'season'      => 'nullable|string|max:255',
            'status'      => 'required|in:published,draft',
            'images.*'    => 'image|mimes:jpeg,png,jpg'
        ]);

        try {
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('events', 'public');
                    $imagePaths[] = $path;
                }
            }

            Event::create([
                'title'       => $request->title,
                'description' => $request->description,
                'event_date'  => $request->event_date,
                'season'      => $request->season,
                'status'      => $request->status,
                'images'      => $imagePaths, // Model cast will handle JSON conversion
            ]);

            return redirect()->back()->with('success', 'Event berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date'  => 'required|date',
            'season'      => 'nullable|string|max:255',
            'status'      => 'required|in:published,draft',
            'images.*'    => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            $event = Event::findOrFail($id);
            $imagePaths = $event->images ?? []; // Keep existing images by default

            // If new images are uploaded, replace the old ones (or you can append based on preference)
            if ($request->hasFile('images')) {
                // Delete old images from storage
                if (!empty($event->images)) {
                    foreach ($event->images as $oldImage) {
                        if (Storage::disk('public')->exists($oldImage)) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }
                }

                $imagePaths = []; // Reset array for new images
                foreach ($request->file('images') as $image) {
                    $path = $image->store('events', 'public');
                    $imagePaths[] = $path;
                }
            }

            $event->update([
                'title'       => $request->title,
                'description' => $request->description,
                'event_date'  => $request->event_date,
                'season'      => $request->season,
                'status'      => $request->status,
                'images'      => $imagePaths,
            ]);

            return redirect()->back()->with('success', 'Event berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $event = Event::findOrFail($id);

            // Hapus gambar dari storage
            if (!empty($event->images)) {
                foreach ($event->images as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            $event->delete();
            return redirect()->back()->with('success', 'Event berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ==========================================
    // SISI USER (MENAMPILKAN HALAMAN EVENT)
    // ==========================================

    public function indexUser()
    {
        // Hanya ambil event yang statusnya published, urutkan dari tanggal terbaru
        $events = Event::where('status', 'published')
            ->orderBy('event_date', 'desc')
            ->get();

        return view('user.component.event', compact('events'));
    }
}
