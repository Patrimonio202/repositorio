<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\Tag;
use App\Models\Tema;
use App\Models\Visita;
use App\Models\Vote;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
  public function temporizador()
  {
    return view('posts.temporizador');
  }

  public function index()
  {
    //Registramos la visita a nuestro sitio if (User::where('id', $user_id )->exists()) {
    // your code...//
   // }
   date_default_timezone_set('America/Lima');
   //$date = Carbon::now();    

    $visita= new Visita();
    $visita->fecha= date('Y-m-d');
    $visita->pagina='Inicio';
    $visita->tipo='1';
    $visita->num='1';

    $visitau=Visita::where('fecha', $visita->fecha)
                     ->where('pagina', 'inicio')->first(); 
                     
    if($visitau){     
      Visita::where('fecha', $visita->fecha)
      ->where('pagina', 'inicio')->update(['num'=>$visitau->num+1]);
    }else{
      $visita->save();
    }

    return view('posts.index');
  }

  public function show(Post $post)
  {
    // guardamos las visitas
    date_default_timezone_set('America/Lima');  

    $visita= new Visita();
    $visita->fecha= date('Y-m-d');
    $visita->pagina=$post->slug;
    $visita->tipo='2';
    $visita->num='1';

    $visitau=Visita::where('fecha', $visita->fecha)
                     ->where('pagina', $post->slug)->first(); 
                     
    if($visitau){     
      Visita::where('fecha', $visita->fecha)
      ->where('pagina', $post->slug)->update(['num'=>$visitau->num+1]);
    }else{
      $visita->save();
    }

    //hasta aqui




    $this->authorize('published', $post);
    $similares = Post::where('category_id', $post->Category->id)
      ->where('status', 2)
      ->where('id', '!=', $post->id)
      ->inRandomOrder()
      ->take(4)
      ->get();
    return view('posts.show', compact('post', 'similares'));
  }

  public function category(Category $category)
  {
    
    $temas=Tema::get();   

    $tags= Tag::where('coleccion', 2)
        ->get();

    $autores=Post::select('autor')
                ->where('category_id',$category->id)
                 ->distinct()
                 ->get();
   // dd($autores);
    return view('posts.category', compact('category', 'tags','temas','autores'));
  }

  public function tag(Tag $tag)
  {
   
    $posts = $tag->posts()->where('status', 2)->latest('id')->paginate(4);
    return view('posts.tag', compact('posts', 'tag'));
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
  public function destacado()
  {

    return view('posts.destacado');
  }

  //mostramos la vista de buscar
  public function buscar()
  {

    $categories = Category::all();
    $tags= Tag::where('coleccion', 2)
                ->get();

    $posts = Post::where('status', 2)
      ->filter(request()->all())
      ->orderBy('id', 'desc')
      ->paginate(24);
    return view('posts.buscar', compact('posts', 'categories', 'tags'));
  }

  public function colecciones(Tag $tag)
  {
    $subcategories=Subcategory::get();

    $categories = Category::all();

    $autores=Post::select('autor')
                 ->whereHas('tags',function (Builder $query)  use($tag){
                  $query->where('tags.id', $tag->id);
                  })
                 ->distinct()
                 ->get();

   $temas=Tema::get(); 

    return view('posts.colecciones', compact('tag', 'subcategories','categories', 'autores', 'temas' ));
  }

  public function acercade()
  {
    return view('acercade');
  }

  public function download(Request $request){
    abort_if(!$request->hasValidSignature(),404);
    return Storage::download($request->query('path'));
  }

}
