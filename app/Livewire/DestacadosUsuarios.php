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

    public function edit($post){ 
        $this->post_slug=Request::root()."/posts/".$post['slug'];       
        $this->open=true;
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
        //$posts=Post::paginate($this->posts_per_page);
        $votes= Vote::select('post_id')->where('user_id', auth()->user()->id)->where('voto', 2)->get();
        $posts= Post::whereIn('id', $votes->toArray())->get();
        return view('livewire.destacados-usuarios',[
            'posts'=>$posts
        ]);
    }

    
    
}
