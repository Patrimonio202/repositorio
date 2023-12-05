<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Menulw extends Component
{
    public function render()
    {
        $posts=Post::where('status',2)
                    ->inRandomOrder()
                    ->first();                   
        return view('livewire.menulw',['posts'  => $posts]);
    }
}
