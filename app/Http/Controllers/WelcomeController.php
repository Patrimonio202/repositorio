<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();

    $posts = Post::where('status', 2)
      ->filter(request()->all())
      ->orderBy('id', 'desc')
      ->paginate(10);
   // return view('posts.buscar', compact('posts', 'categories'));


       // $posts=Post::all();
        return view('posts.prueba', compact('posts', 'categories'));
    }
}
