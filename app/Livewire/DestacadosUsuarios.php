<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Vote;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class DestacadosUsuarios extends Component
{

    use WithPagination;
    public $posts_per_page=6;
    public $totalRecords;

    public $open=false;  // con este abrimos el modal
    public $post_slug;

     //este es para darle me interesa
     public function meinteresa($postId)
     {
        abort_unless(auth()->check(), 403); // seguridad v1.0 (30/10/2026): requiere sesion
        //$post = Post::find($postId);
 
         //dd($post->userVotes->id); 
         $vote = new Vote();
         $vote->voto='2';
         $vote->post_id = $postId;        
         $vote->user_id = auth()->user()->id; 
        
        //buscamos, si el me encanta existe lo eliminamos y si no lo creamos
         if (Vote::where('post_id',$postId )->where('user_id',auth()->user()->id )->where('voto',2)->exists()) {
             Vote::where('post_id', '=', $postId)
              ->where('user_id', '=', auth()->user()->id)->where('voto','=',2)
           ->delete();
         }else{
             $vote->save();
         } 
        
     }
    
    // este metodo es para darle me gusta a una publicación
    public function megusta($postId)
    {      
        abort_unless(auth()->check(), 403); // seguridad v1.0 (30/10/2026): requiere sesion
        $vote = new Vote();
        $vote->voto='1';
        $vote->post_id = $postId;        
        $vote->user_id = auth()->user()->id; 
       
       //buscamos, si el me encanta existe lo eliminamos y si no lo creamos
        if (Vote::where('post_id',$postId )->where('user_id',auth()->user()->id)->where('voto',1)->exists()) {
            Vote::where('post_id', '=', $postId)
             ->where('user_id', '=', auth()->user()->id)->where('voto','=',1)
          ->delete();
        }else{
            $vote->save();
        }       
    }

    public function mount(){    
       $this->totalRecords=Post::count();
    }

    public function loadMore(){
        $this->posts_per_page +=3;
    }

    // rendimiento v1.0 (30/10/2026): recibe solo el id (antes llegaba toda la publicacion desde el navegador)
    public function edit($postId)
    {
        $slug = Post::whereKey($postId)->value('slug');
        $this->post_slug = Request::root() . "/posts/" . $slug;
        $this->open = true;
    }

    // rendimiento v1.0 (30/10/2026): recibe solo el id y lee la ruta desde la base de datos (antes confiaba en datos enviados por el navegador)
    public function download($postId)
    {
        abort_unless(auth()->check(), 403); // seguridad v1.0 (30/10/2026): requiere sesion
        $post = Post::with('image')->findOrFail($postId);
        $vpost = $post->image;
        if ($post->category_id == '1') {
            return Storage::download($vpost->url);
        }
        if ($post->category_id == '2' || $post->category_id == '3') {
            return Storage::download($vpost->urlarchivo);
        }
    }

    public function render()
    {
        //$posts=Post::paginate($this->posts_per_page);
        $votes = Vote::where('user_id', auth()->id())->where('voto', 2)->pluck('post_id');
        $posts = Post::with(['image', 'category'])->whereIn('id', $votes)->get();
        return view('livewire.destacados-usuarios',[
            'posts'=>$posts
        ]);
    }

    
    
}
