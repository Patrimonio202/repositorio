<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\Tema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
        $this->middleware('can:admin.imagenes')->only('imagenes', 'updateimagenes');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $temas = Tema::pluck('name', 'id'); // esto es para pasarle a laravel collection   
        $categories = Category::pluck('name', 'id'); // esto es para pasarle a laravel collection  
        $subcategories= Subcategory:: pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags', 'temas', 'subcategories'));
    }


    public function store(PostRequest $request)
    {
        // tener pendiente, en produccion cambiamos las rutas
        $post = Post::create($request->all());
        if ($request->file('file')) {
            $nameimagen = $request->file('file')->getClientOriginalName();
            $url =  Storage::putFileAs('archivos', $request->file('file'), $nameimagen, 'public');   //me almacena la informacion de la carpeta temporal a la public
            Image::generarVariantes($url);   // rendimiento v1.2 (30/10/2026): miniatura al subir
            //$url=Storage::put('archivos', $request->file('file')); 
            $urlarchivo = '';

            //validamos si es un audio2 o un libro3
            if ($request->category_id == '2' || $request->category_id == '3') {
                if ($request->file('archivo')) {
                    //el disco original es public                   
                    $namearchivo = $request->file('archivo')->getClientOriginalName();
                    // dd($namearchivo);   
                    $urlarchivo = Storage::putFileAs('archivos', $request->file('archivo'), $namearchivo, 'public');
                    //guardamos el post-> image
                    $post->image()->create([
                        'url' => $url,
                        'urlarchivo' => $urlarchivo,
                        'urlyoutube' => ''
                    ]);
                }
            } else {
                $post->image()->create([
                    'url' => $url,
                    'urlarchivo' => $urlarchivo,
                    'urlyoutube' => $request->urlyoutube
                ]);
            }
        } else {
            //hasta aqui        
            if ($request->category_id == '4') {
                $post->image()->create([
                    'url' => '',
                    'urlarchivo' => '',
                    'urlyoutube' => $request->urlyoutube
                ]);
            }
        }

        //con este creamos las etiquetas que son de uno a muchos
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //$this->authorize('author', $post);
        $temas = Tema::pluck('name', 'id'); // esto es para pasarle a laravel collection   
        $categories = Category::pluck('name', 'id'); // esto es para pasarle a laravel collection   
        $subcategories= Subcategory:: pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'temas', 'subcategories'))->with('info', 'El post se creó con exito');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        // $this->authorize('author', $post);
        $post->update($request->all());
        //validamos si tiene una imagen el posts
        if ($request->file('file')) {
            if ($post->image) {
                Storage::delete($post->image->url);  // con este eliminamos la foto cargada
                Image::eliminarVariantes($post->image->url);
            }
            $nameimagen = $request->file('file')->getClientOriginalName();
            $url =  Storage::putFileAs('archivos', $request->file('file'), $nameimagen, 'public');   //me almacena la informacion de la carpeta temporal a la public
            Image::generarVariantes($url);   // rendimiento v1.2 (30/10/2026): miniatura al subir
            //si tiene la imagen
            if ($post->image) {
                $post->image->update([
                    'url' => $url
                ]);
            } else {
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        //validamos si tiene un archivo como audio o pdf
        if ($request->file('archivo')) {
            // con este eliminamos la foto cargada
            if ($post->image->urlarchivo) {
                Storage::delete($post->image->urlarchivo);
            }
            // con este cargamos una imagen
            $nameimagena = $request->file('archivo')->getClientOriginalName();
            $urlarchivo = Storage::putFileAs('archivos', $request->file('archivo'), $nameimagena, 'public');   //me almacena la informacion de la carpeta temporal a la public

            //si tiene la imagen actualizamos el dato y si no, la creamos
            if ($post->image) {
                $post->image->update([
                    'urlarchivo' => $urlarchivo
                ]);
            } else {
                $post->image()->create([
                    'urlarchivo' => $urlarchivo
                ]);
            }
        }
        //validamos si es un video
        if ($request->category_id == '4') {
            if ($post->image) {
                $post->image()->update([
                    'urlyoutube' => $request->urlyoutube
                ]);
            }
        }
        //hasta aqui      

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se actualizó con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('author', $post);
        if ($post->image->url) {
            Storage::delete($post->image->url);  // con este eliminamos la foto cargada
            Image::eliminarVariantes($post->image->url);
        }
        if ($post->image->urlarchivo) {
            Storage::delete($post->image->urlarchivo);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('info', 'El post se eliminó con exito');
    }

    public function imagenes()
    {
        return view('admin.posts.Imagenes');
    }

    public function updateimagenes(Request $request)
    {
        // parche-subidas v1.0 (30/10/2026): solo identificadores de la lista y solo imagenes reales
        $permitidos = [
            'Imagen-barner-1', 'Imagen-barner-2', 'Imagen-barner-3', 'Imagen-barner-4', 'Imagen-barner-5',
            'Favicon', 'Logo', 'Imagenes', 'Audios', 'Libros', 'Videos', 'Fondologin',
            'TituloImagenes', 'TituloAudios', 'TituloPublicaciones', 'TituloVideos',
            'ImagenCompartirRepositorio',
        ];
        $request->validate([
            'idimagen' => ['required', Rule::in($permitidos)],
            'file' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
        ]);

        // la extension sale del contenido real del archivo, no de lo que diga el cliente
        $ext = strtolower($request->file('file')->guessExtension() ?: 'jpg');
        if ($ext === 'jpeg') {
            $ext = 'jpg';
        }
        $namearchivo = $request->idimagen . '.' . $ext;
        Storage::putFileAs('Imagenes', $request->file('file'), $namearchivo, 'public');
        // rendimiento v1.2 (30/10/2026): miniaturas (los banners tambien en 1920 px)
        Image::generarVariantes('Imagenes/' . $namearchivo, str_starts_with($request->idimagen, 'Imagen-barner'));
        return redirect()->route('admin.updateimagenes')->with('info', 'la imagen se actualizó correctamente');
    }
}
