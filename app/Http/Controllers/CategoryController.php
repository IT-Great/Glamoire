<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CategoryArticle;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Validators\ValidationException;

class CategoryController extends Controller
{
    public function indexCategoryProduct()
    {
        // Mengambil kategori yang tidak memiliki parent_id dan mengurutkannya berdasarkan created_at
        $categories = CategoryProduct::with('children.children')
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan kolom created_at terbaru
            ->get();

        return view('admin.category.index', compact('categories'));
    }



    public function createCategoryProduct(Request $request)
    {
        try {
            $rules = [
                'name' => ['required', 'string', 'max:255'],
            ];

            // 🔑 Jika CATEGORY (parent_id = null) → HARUS UNIQUE
            if (empty($request->parent_id)) {
                $rules['name'][] = Rule::unique('category_products')
                    ->whereNull('parent_id');
            }

            $request->validate($rules);

            $category = CategoryProduct::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id
            ]);

            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Nama category sudah ada.'
            ], 422);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
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
        $categoryArticle = CategoryArticle::with(['articles'])->get(); // Eager load
        $articles = Article::count(); // Jumlah artikel
        $categories = $categoryArticle->count(); // Hitung jumlah kategori saja

        return view('admin.article.category.index', compact('categoryArticle', 'articles', 'categories'));
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
