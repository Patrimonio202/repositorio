<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

use function Livewire\store;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function creating(Post $post): void
    {
       if( ! \App::runningInConsole()){
        $post->user_id=auth()->user()->id;
       }
    }

   
    /**
     * el metodo deleted se activa despues de borrar deleting se activa antes de 
     */
    public function deleting(Post $post): void
    {
        if($post->image){
            //Eliminamnos los archivos de imagen
            if($post->image->url){
               Storage::disk('s3')->delete($post->image->url);
            }
            // eliminamos los pdf  o archivos de musica
            if($post->image->urlarchivo){
                Storage::disk('s3')->delete($post->image->urlarchivo);
             }
        }
    
    }

   
}
