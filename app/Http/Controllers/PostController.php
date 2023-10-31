<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(){
        $posts= Post::where('status',2)->latest('id')->paginate(8);
        return view('posts.index',compact('posts'));
    }

    public function show($post){ 
      //  $curso =Curso::find($id);
      $post=Post::find($post);    
      $this->authorize('published',$post );
      $similares= Post::where('category_id',$post->Category->id )
                        ->where('status',2)
                        ->where('id','!=', $post->id)
                        ->latest('id')
                        ->take(4)
                        ->get();
     return view('posts.show', compact('post','similares'));
    }

    public function category(Category $category){
        $posts=Post::where('category_id', $category->id)
                    ->where('status',2)
                    ->latest('id')
                    ->paginate(6);
      return view('posts.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag){
      $posts= $tag->posts()->where('status',2)->latest('id')->paginate(4);     
      return view('posts.tag', compact('posts','tag'));
    }

    //metodo para guardar me encanta en la base de datos
    public function meencanta(Request $request): JsonResponse
    {
    //   $request->validate([
    //     'title' => 'required',
    //     'body' => 'required',
    // ]);
     
    // Post::create([
    //     'title' => $request->title,
    //     'body' => $request->body,
    // ]);
      return  response()->json(['success' => 'Post created successfully.']);
    }

    //mostramos todos los post destacados que tiene un usuario
    public function destacado(){     
     // $votes=Vote::where('user_id', auth()->user()->id)->get();
      //dd($votes);      
      //return $votes[1] ;
      return view('posts.destacado');
    }
}
