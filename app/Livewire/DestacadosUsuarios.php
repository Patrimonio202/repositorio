<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

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

    public function mount(){    
               //$this->posts =Post::all();    
               $this->totalRecords=Post::count();
    }

    public function loadMore(){
        $this->posts_per_page +=6;
    }

    public function render()
    {
        $posts=Post::paginate($this->posts_per_page);
        return view('livewire.destacados-usuarios',[
            'posts'=>$posts
        ]);
    }

    
}
