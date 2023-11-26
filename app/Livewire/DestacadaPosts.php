<?php

namespace App\Livewire;


use App\Models\Tag;
use Livewire\Component;


class DestacadaPosts extends Component
{
  public $tags=null;

   public function loadPosts()
   {
    $this->tags = Tag::where('coleccion', 2)
    ->limit(4)
    ->get();    
   }

 

  public function render()
  {

    return view('livewire.destacada-posts');
  }
}
