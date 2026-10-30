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

  // rendimiento v1.0 (30/10/2026): una sola consulta en el caso comun (antes: SELECT + UPDATE en cada visita)
  private function registrarVisita(string $pagina, string $tipo): void
  {
    $fecha = date('Y-m-d');
    $filas = Visita::where('fecha', $fecha)->where('pagina', $pagina)->increment('num');
    if (!$filas) {
      Visita::create(['fecha' => $fecha, 'pagina' => $pagina, 'tipo' => $tipo, 'num' => '1']);
    }
  }

  public function index()
  {
    //Registramos la visita a nuestro sitio if (User::where('id', $user_id )->exists()) {
    // your code...//
   // }
   date_default_timezone_set('America/Lima');
   //$date = Carbon::now();    

    $this->registrarVisita('Inicio', '1');

    return view('posts.index');
  }

  public function show(Post $post)
  {
    // guardamos las visitas
    date_default_timezone_set('America/Lima');  

    $this->registrarVisita($post->slug, '2');

    //hasta aqui




    $this->authorize('published', $post);
    // rendimiento v1.0 (30/10/2026): se sortean 4 ids en PHP (antes ORDER BY RAND() sobre toda la categoria con el texto completo)
    $ids = Post::where('category_id', $post->category_id)
      ->where('status', 2)
      ->where('id', '!=', $post->id)
      ->pluck('id');
    $similares = $ids->isEmpty()
      ? (new Post)->newCollection()
      : Post::with(['image', 'category'])->whereIn('id', $ids->shuffle()->take(4)->all())->get();
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
   
    $posts = $tag->posts()->with(['image', 'category'])->where('status', 2)->latest('id')->paginate(4);
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
      ->with(['image', 'category'])
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
