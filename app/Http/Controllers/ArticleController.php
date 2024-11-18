<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;

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


    public function editArticle()
    {
        return view('admin.article.edit');
    }

    public function updateArticle() {}

    public function deleteArticle() {}


    // USER
    public function articleUser(){
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

    public function detailArticleUser($name){
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
