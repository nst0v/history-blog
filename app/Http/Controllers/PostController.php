<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService
    ) {}

    public function index(Request $request): View
    {
        $posts = $this->postService->getAllPosts(12);

        return view('posts.index', compact('posts'));
    }

    public function show(string $slug): View
    {
        $post = $this->postService->getPostBySlug($slug);

        if (!$post) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }
}
