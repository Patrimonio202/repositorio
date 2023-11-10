<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Request;

class DestacadosUsuarios extends Component
{
//    public $totalRecords;
//    public $loadAmount=2;

//     //public $posts;

//     public function loadMore(){
//         $this->loadAmount+=4;
//     }

//     public function mount(){    
//       //$this->posts =Post::all();    
//         $this->totalRecords=Post::count();
//     }

//     public function render()
//     {
//         return view('livewire.destacados-usuarios')->with('posts', 
//         Post::limit($this->loadAmount)->get());
//     }
    use WithPagination;
    public $posts_per_page=2;
    public $totalRecords;

    public $open=false;  // con este abrimos el modal
    public $post_slug;
    

    public function mount(){    
               //$this->posts =Post::all();    
               $this->totalRecords=Post::count();
    }

    public function loadMore(){
        $this->posts_per_page +=6;
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

    public function edit($post){    
        //dd($post['slug']);  
        $this->post_slug=Request::root()."/posts/".$post['slug'];
       
       // dd($this->post_slug);
        $this->open=true;
    }

    
}
