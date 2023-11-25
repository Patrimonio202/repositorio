<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.create')->only('create', 'store');
        $this->middleware('can:admin.tags.edit')->only('edit', 'update');   
        $this->middleware('can:admin.tags.destroy')->only('destroy');      
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors=[
            'red'=>'Color rojo',
            'yellow'=>'Color amarillo',
            'green'=>'Color verde',
            'blue'=>'Color azul',
            'indigo'=>'Color indigo',
            'purple'=>'Color morado',
            'pink'=>'Color rosado'            
        ];
        return view('admin.tags.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage. Request
     */
    public function store(Request $request)
    {    
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:tags',
            'color'=>'required'
        ]);

        $tag= new Tag();
        $tag->name= $request->name;
        $tag->slug=$request->slug;
        $tag->color=$request->color;
        $tag->coleccion=$request->coleccion;
        $tag->titulocoleccion=$request->titulocoleccion;       
      //$tag=  Tag::create($request->all());

      if ($request->file('file')) {
        $nameimagen = $request->file('file')->getClientOriginalName();
        $url =  Storage::putFileAs('archivos', $request->file('file'), $nameimagen, 'public');   //me almacena la informacion de la carpeta temporal a la public
        $tag->url=$url;
      }

      //dd($tag);
      $tag-> save();
      
      return redirect()->route('admin.tags.edit',compact('tag'))->with('info', 'La etiqueta se creó con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $colors=[
            'red'=>'Color rojo',
            'yellow'=>'Color amarillo',
            'green'=>'Color verde',
            'blue'=>'Color azul',
            'indigo'=>'Color indigo',
            'purple'=>'Color morado',
            'pink'=>'Color rosado'            
        ];
        return view('admin.tags.edit', compact('tag','colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {       
        $request->validate([
            'name'=>'required',
            'slug'=>"required|unique:tags,slug,$tag->id" ,
            'color'=>'required'
        ]);

       // $tagf= new Tag();
        $tag->name= $request->name;
        $tag->slug=$request->slug;
        $tag->color=$request->color;
        $tag->coleccion=$request->coleccion;
        $tag->titulocoleccion=$request->titulocoleccion;  

        //verificamos si tiene         
        if ($request->file('file')) {           
            if ($tag->url) {
                Storage::delete($tag->url);  // con este eliminamos la foto cargada               
            }
            $nameimagen = $request->file('file')->getClientOriginalName();
            $url =  Storage::putFileAs('archivos', $request->file('file'), $nameimagen, 'public');   //me almacena la informacion de la carpeta temporal a la public
            $tag->url=$url;
        }
               
        //$tag->update($tagf->all());
        $tag-> save();
        return redirect()->route('admin.tags.edit',$tag)->with('info', 'La etiqueta se actualizó con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Tag $tag)
    {
        if ($tag->url) {
            Storage::delete($tag->url);  // con este eliminamos la foto cargada               
        }
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('info', 'La etiqueta se eliminó con exito');
    }
}
