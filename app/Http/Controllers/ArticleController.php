<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function indexArticleAdmin()
    {

        $articles = Article::with(['categoryArticle'])->paginate(9); // Eager load kategori dan brand

        return view('admin.article.index', [
            'articles' => $articles,
        ]);
    }

    public function createArticle()
    {
        $categories = CategoryArticle::all();

        return view('admin.article.create', [
            'categories' => $categories,
        ]);
    }

    public function reviewArticle($id)
    {
        $article = Article::find($id);
        $categoryArticle = CategoryArticle::all();

        return view('admin.article.review', [
            'article' => $article,
            'categoryArticle' => $categoryArticle,
        ]);
    }

    public function storeArticle(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_article_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ]);

        // Simpan single image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Simpan file ke storage/app/public/uploads/promo
            $imagePath = $image->storeAs('article', $imageName, 'public');
        }

        Article::create([
            'title' => $request->title,
            'category_article_id' => $request->category_article_id,
            'image' => $imagePath,
            'content' => $request->content,
        ]);

        return redirect()->route('index-article')->with('success', 'Article created successfully!');
    }


    // public function editArticle()
    // {
    //     return view('admin.article.edit');
    // }

    // Add these methods to your existing Article controller

    // Show edit form
    public function editArticle($id)
    {
        $article = Article::findOrFail($id);
        $categories = CategoryArticle::all(); // Assuming you have this model

        return view('admin.article.edit', compact('article', 'categories'));
    }

    // Process update
    public function updateArticle(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category_article_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ]);

        $article = Article::findOrFail($id);

        // Handle image update
        $imagePath = $article->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('article', $imageName, 'public');
        }

        // Update article
        $article->update([
            'title' => $request->title,
            'category_article_id' => $request->category_article_id,
            'image' => $imagePath,
            'content' => $request->content,
        ]);

        return redirect()->route('index-article')->with('success', 'Article updated successfully!');
    }


    public function deleteArticle($id)
    {
        try {
            $article = Article::find($id);

            if (!$article) {
                Log::warning("Artikel dengan ID {$id} tidak ditemukan saat penghapusan.");
                return response()->json([
                    'success' => false,
                    'message' => 'Artikel tidak ditemukan.'
                ], 404);
            }

            // Hapus gambar jika ada
            if (!empty($article->image) && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            // Hapus artikel dari database
            $article->delete();

            Log::info("Artikel dengan ID {$id} berhasil dihapus.");

            return response()->json([
                'success' => true,
                'message' => 'Artikel berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus artikel: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus artikel.'
            ], 500);
        }
    }


    // USER
    public function articleUser()
    {
        $articles = Article::with(['categoryArticle'])->get();
        $categoryArticles = CategoryArticle::with(['articles'])
            ->get();

        // dd(count($categoryArticles));

        // dd($categoryArticles);
        return view('user.component.newsletter', [
            'articles' => $articles,
            'categoryArticles' => $categoryArticles,
        ]);
    }

    public function detailArticleUser($name)
    {
        $article = Article::where('title', $name)->with(['categoryArticle'])->first();
        $categoryArticles = CategoryArticle::with(['articles'])
            ->get();
        $articles = Article::with(['categoryArticle'])->get();

        // dd($categoryArticles);
        return view('user.component.blog', [
            'article' => $article,
            'categoryArticles' => $categoryArticles,
            'articles' => $articles,
        ]);
    }
}
