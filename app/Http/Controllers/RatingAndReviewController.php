<?php

namespace App\Http\Controllers;

use App\Models\RatingAndReview;
use Illuminate\Http\Request;

class RatingAndReviewController extends Controller
{
    public function index()
    {
        // Eager loading relasi untuk mencegah N+1 Query Problem yang memberatkan server
        $reviews = RatingAndReview::with(['user', 'product', 'order.invoice'])
                    ->latest()
                    ->get();

        return view('admin.rating_and_reviews.index', compact('reviews'));
    }
}
