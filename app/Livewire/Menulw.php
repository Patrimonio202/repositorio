<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class Menulw extends Component
{
    public function render()
    {
        $postId = Cache::remember('menu.random-post-id', now()->addMinutes(10), function () {
            $query = Post::where('status', 2);
            $count = $query->count();

            return $count > 0
                ? $query->skip(random_int(0, $count - 1))->value('id')
                : null;
        });

        $posts = $postId ? Post::find($postId) : null;
        return view('livewire.menulw',['posts'  => $posts]);
    }
}
