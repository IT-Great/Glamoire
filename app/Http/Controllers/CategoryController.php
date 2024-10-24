<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryArticle;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function indexCategoryProduct()
    {
        $categories = CategoryProduct::with('children.children')->whereNull('parent_id')->get();
        return view('admin.category.index', compact('categories'));
    }

    // public function createCategoryProduct(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'parent_id' => 'nullable|exists:category_products,id'
    //     ]);

    //     CategoryProduct::create([
    //         'name' => $request->name,
    //         'parent_id' => $request->parent_id
    //     ]);

    //     return response()->json(['success' => true]);
    // }

    public function createCategoryProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required|exists:category_products,id' // Memastikan parent_id ada dan valid
        ]);

        $subcategory = CategoryProduct::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id // Ini akan menjadi subcategory karena memiliki parent_id
        ]);

        return response()->json([
            'success' => true,
            'data' => $subcategory
        ]);
    }
    
    public function deleteCategoryProduct($id)
    {
        $category = CategoryProduct::find($id);

        if ($category) {
            $category->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Category not found']);
    }

    // CATEGORY ARTICLE
    public function indexCategoryArticle()
    {
        $categoryArticle = CategoryArticle::all(); // Mengambil semua data kategori
        return view('admin.article.category.index', compact('categoryArticle'));
    }

    public function createCategoryArticle(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = CategoryArticle::create([
            'name' => $request->name
        ]);

        return response()->json(['success' => true, 'category' => $category]);
    }

    public function deleteCategoryArticle($id)
    {
        $category = CategoryArticle::find($id);

        if ($category) {
            $category->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Category not found']);
    }
}
