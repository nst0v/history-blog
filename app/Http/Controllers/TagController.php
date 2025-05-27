<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    public function __construct(
        private TagService $tagService,
        private PostService $postService
    ) {}

    public function index(): View
    {
        $tags = $this->tagService->getAllTags();

        return view('tags.index', compact('tags'));
    }

    public function show(string $slug): View
    {
        $result = $this->postService->getPostsByTag($slug);

        if (!$result['tag']) {
            abort(404);
        }

        return view('tags.show', [
            'tag' => $result['tag'],
            'posts' => $result['posts']
        ]);
    }
}
