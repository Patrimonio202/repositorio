<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Vote;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class MultimediaPublicada extends Component
{
    use WithPagination;
    public $posts_per_page=3;
    public $totalRecords;

    public $open=false;  // con este abrimos el modal
    public $post_slug;

    //este es para darle me interesa
    public function meinteresa($postId)
    {
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

        //$this->iddepost = $postId;
        //$this->clasemeinteresa = "fa-solid fa-heart fa-lg";
    }

    // este metodo es para darle me gusta a una publicación
    public function megusta($postId)
    {      
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

    public function mount()
    {
        //$this->totalRecords=Post::count();
        $this->totalRecords=9;
    }
    public function loadMore(){
        if ($this->posts_per_page<12){
        $this->posts_per_page +=3;
        }
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
        $post = Post::with('image')->findOrFail($postId);
        $vpost = $post->image;
        if ($post->category_id == '1') {
            return redirect(Storage::temporaryUrl($vpost->url, now()->addHour(), ['ResponseContentDisposition' => 'attachment']));
        }
        if ($post->category_id == '2' || $post->category_id == '3') {
            return redirect(Storage::temporaryUrl($vpost->urlarchivo, now()->addHour()));
        }
    }

  
    public function render()
    {       
        //$posts=Post::where('status', 2)->latest('id')->paginate($this->posts_per_page);
        $posts=null;
        
        if($this->posts_per_page==3){            
            $posts=Post::with(['image', 'category'])->where('status', 2)->where('category_id','1')->latest('id')->take(3)->get();
        }
        if($this->posts_per_page==6){            
            $posts=Post::with(['image', 'category'])->where('status', 2)->where('category_id','1')->latest('id')->take(3)
            ->union(Post::where('status', 2)->where('category_id','2')->latest('id')->take(3))->get();
        }
        if($this->posts_per_page==9){            
            $posts=Post::with(['image', 'category'])->where('status', 2)->where('category_id','1')->latest('id')->take(3)
            ->union(Post::where('status', 2)->where('category_id','2')->latest('id')->take(3))
            ->union(Post::where('status', 2)->where('category_id','3')->latest('id')->take(3))->get();
        }

        if($this->posts_per_page==12){            
            $posts=Post::with(['image', 'category'])->where('status', 2)->where('category_id','1')->latest('id')->take(3)
            ->union(Post::where('status', 2)->where('category_id','2')->latest('id')->take(3))
            ->union(Post::where('status', 2)->where('category_id','3')->latest('id')->take(3))
            ->union(Post::where('status', 2)->where('category_id','4')->latest('id')->take(3))->get();
        }      
       
        return view('livewire.multimedia-publicada', compact('posts'));
    }
}
