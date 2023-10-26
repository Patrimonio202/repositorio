<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Vote;
use Livewire\Component;


class DestacadaPosts extends Component
{
  // //este es para darle me interesa
  // public function meinteresa($postId)
  // {
  //   $vote = new Vote();
  //   $vote->voto = '2';
  //   $vote->post_id = $postId;
  //   $vote->user_id = auth()->user()->id;

  //   //buscamos, si el me encanta existe lo eliminamos y si no lo creamos
  //   if (Vote::where('post_id', $postId)->where('user_id', auth()->user()->id)->where('voto', 2)->exists()) {
  //     Vote::where('post_id', '=', $postId)
  //       ->where('user_id', '=', auth()->user()->id)->where('voto', '=', 2)
  //       ->delete();
  //   } else {
  //     $vote->save();
  //   }
  // }

  // // este metodo es para darle me gusta a una publicación
  // public function megusta($postId)
  // {
  //   $vote = new Vote();
  //   $vote->voto = '1';
  //   $vote->post_id = $postId;
  //   $vote->user_id = auth()->user()->id;

  //   //buscamos, si el me encanta existe lo eliminamos y si no lo creamos
  //   if (Vote::where('post_id', $postId)->where('user_id', auth()->user()->id)->where('voto', 1)->exists()) {
  //     Vote::where('post_id', '=', $postId)
  //       ->where('user_id', '=', auth()->user()->id)->where('voto', '=', 1)
  //       ->delete();
  //   } else {
  //     $vote->save();
  //   }
  // }
  public $posts;

  public function mount()
  {
    $this->posts = Post::all();
  }

  public function render()
  {
    return view('livewire.destacada-posts');
  }
}
