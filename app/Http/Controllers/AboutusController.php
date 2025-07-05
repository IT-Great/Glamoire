<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|max:2048',

            'intro_title' => 'nullable|string|max:255',
            'intro_description' => 'nullable|string',
            'intro_image' => 'nullable|image|max:2048',

            'vision_title' => 'nullable|string|max:255',
            'vision_description' => 'nullable|string',
            'vision_image' => 'nullable|image|max:2048',

            'mission_title' => 'nullable|string|max:255',
            'mission_description' => 'nullable|string',
            'mission_image' => 'nullable|image|max:2048',

            'story_title' => 'nullable|string|max:255',
            'story_description' => 'nullable|string',
            'story_image' => 'nullable|image|max:2048',

            'achievement_title' => 'nullable|string|max:255',
            'achievement_description' => 'nullable|string',
            'achievement_image' => 'nullable|image|max:2048',
        ]);

        // proses upload file untuk semua gambar
        foreach (['hero', 'intro', 'vision', 'mission', 'story', 'achievement'] as $section) {
            $field = "{$section}_image";
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('aboutus', 'public');
            }
        }

        AboutUs::create($validated);

        return redirect()->route('index-aboutus-admin')->with('success', 'About Us created successfully!');
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

            'vision_title' => 'nullable|string|max:255',
            'vision_description' => 'nullable|string',
            'vision_image' => 'nullable|image|max:2048',

            'mission_title' => 'nullable|string|max:255',
            'mission_description' => 'nullable|string',
            'mission_image' => 'nullable|image|max:2048',

            'story_title' => 'nullable|string|max:255',
            'story_description' => 'nullable|string',
            'story_image' => 'nullable|image|max:2048',

            'achievement_title' => 'nullable|string|max:255',
            'achievement_description' => 'nullable|string',
            'achievement_image' => 'nullable|image|max:2048',
        ]);

        // proses upload file untuk semua gambar
        foreach (['hero', 'intro', 'vision', 'mission', 'story', 'achievement'] as $section) {
            $field = "{$section}_image";
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('aboutus', 'public');
            }
        }

        $aboutUs->update($validated);

        return redirect()->route('index-aboutus-admin')->with('success', 'About Us updated successfully!');
    }
}
