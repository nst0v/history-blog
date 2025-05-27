<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService,
        private PostService $postService
    ) {}

    public function index(): View
    {
        $categories = $this->categoryService->getAllCategories();

        return view('categories.index', compact('categories'));
    }

    public function show(string $slug): View
    {
        $result = $this->postService->getPostsByCategory($slug);

        if (!$result['category']) {
            abort(404);
        }

        return view('categories.show', [
            'category' => $result['category'],
            'posts' => $result['posts']
        ]);
    }
}
