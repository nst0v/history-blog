<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private HomeService $homeService
    ) {}

    public function index(): View
    {
        $data = $this->homeService->getHomePageData();

        return view('home.index', $data);
    }
}
