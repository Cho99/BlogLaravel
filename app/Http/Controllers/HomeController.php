<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\News;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $page = 3;
        //$news = News::paginate($page);
        $news = News::orderBy('id','DESC')->get();
        return view('news.news', ['news' => $news]);
    }
}
