<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $page = Page::firstOrCreate(['slug' => 'home'], ['title' => 'Главная страница','content'=>'<h2>Главная страница</h2>']);
        return view('home', ['page' => $page]);
    }
}
