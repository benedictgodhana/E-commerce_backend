<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Fetch all categories with their products
        $categories = Category::with('products')->get();

        return response()->json($categories);
    }
}
