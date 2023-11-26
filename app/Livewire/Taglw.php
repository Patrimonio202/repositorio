<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Vote;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class Taglw extends Component
{
    public $posts_per_page=4;
    public $totalRecords;

    public $open=false;  // con este abrimos el modal
    public $post_slug;

    public $tag;

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
       $this->totalRecords=$this->tag->posts()->where('status',2)->count();        
    }

    public function edit($post){    
        //dd($post['slug']);  
        $this->post_slug=Request::root()."/posts/".$post['slug'];
        
        $this->open=true;
    }

    public function loadMore(){
        $this->posts_per_page +=4;
    }

    public function download($post){    
        $vpost=$post['image'];     
        if($post['category_id']=='1') {
            return Storage::download($vpost['url']);
        }  
        
        if($post['category_id']=='2' || $post['category_id']=='3' ) {
            return Storage::download($vpost['urlarchivo']);
        }  
       
    }

    public function render()
    {
       // $posts=Post::where('category_id',$this->category->id)
                    //->where('status', 2)->latest('id')->paginate($this->posts_per_page);   
        $posts= $this->tag->posts()->where('status',2)->latest('id')->paginate($this->posts_per_page);        
        return view('livewire.taglw', compact('posts'));
    }
}
