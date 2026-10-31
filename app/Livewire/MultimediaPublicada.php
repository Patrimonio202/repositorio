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
    // Dos filas completas en escritorio; las siguientes cargas suman otra fila.
    public $posts_per_page=6;
    public $totalRecords;
    public array $randomPostIds = [];

    public $open=false;  // con este abrimos el modal
    public $post_slug;

    public function placeholder()
    {
        return <<<'HTML'
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-2 -mr-4" aria-hidden="true">
            <div class="h-96 mr-4 md:mx-8 lg:mx-8 my-10 rounded-xl bg-white"></div>
            <div class="hidden h-96 md:block md:mx-8 my-10 rounded-xl bg-white"></div>
            <div class="hidden h-96 lg:block lg:mx-8 my-10 rounded-xl bg-white"></div>
        </div>
        HTML;
    }

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
        // v1.1 (30/10/2026): las 6 primeras son publicaciones al azar que NO son videos
        // (categoria 4) y las 6 ultimas son videos al azar. Solo se barajan IDs, una vez,
        // y el orden se conserva durante todas las interacciones de Livewire.
        $noVideos = Post::where('status', 2)
            ->where('category_id', '!=', 4)
            ->whereHas('image')
            ->pluck('id')
            ->shuffle()
            ->take(6);

        $videos = Post::where('status', 2)
            ->where('category_id', 4)
            ->whereHas('image', fn ($q) => $q->whereNotNull('urlyoutube')->where('urlyoutube', '!=', ''))
            ->pluck('id')
            ->shuffle()
            ->take(6);

        $this->randomPostIds = $noVideos->concat($videos)->values()->all();
        $this->totalRecords = count($this->randomPostIds);
    }
    public function loadMore(){
        if ($this->posts_per_page < $this->totalRecords) {
            $this->posts_per_page = min($this->posts_per_page + 3, $this->totalRecords);
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
        $visibleIds = array_slice($this->randomPostIds, 0, $this->posts_per_page);
        $positions = array_flip($visibleIds);

        $posts = Post::with(['image', 'category'])
            ->whereIn('id', $visibleIds)
            ->get()
            ->sortBy(fn (Post $post) => $positions[$post->id] ?? PHP_INT_MAX)
            ->values();

        return view('livewire.multimedia-publicada', compact('posts'));
    }
}
