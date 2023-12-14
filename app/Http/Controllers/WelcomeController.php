<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        //         $categories = Category::all();

        //     $posts = Post::where('status', 2)
        //       ->filter(request()->all())
        //       ->orderBy('id', 'desc')
        //       ->paginate(10);
        //    // return view('posts.buscar', compact('posts', 'categories'));


        //        // $posts=Post::all();
        //         return view('posts.prueba', compact('posts', 'categories'));
        //
        //request()->all()  request()->hasta
        $posts = Post::where('status', 2)
            ->whereBetween('id', [request()->desde, request()->hasta])
            ->get();

        foreach ($posts as $post) {
            if ($post->category_id == '1' ||  $post->category_id == '2' || $post->category_id == '3') {
                if ($post->image->url) {
                    $fileName = $post->image->url;
                    //dd($fileName);
                    $public = Storage::disk('public');
                    $s3 = Storage::disk('s3');
                    $public->writeStream($fileName, $s3->readStream($fileName));
                }
            }

            if ($post->category_id == '2' || $post->category_id == '3') {
                $fileName = $post->image->urlarchivo;
                //dd($fileName);
                $public = Storage::disk('public');
                $s3 = Storage::disk('s3');
                $public->writeStream($fileName, $s3->readStream($fileName));
            }
        }
    }
}
