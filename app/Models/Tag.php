<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable=['name', 'slug','color','coleccion', 'url', 'titulocoleccion']; 

    public function getRouteKeyName()
    {
         return 'slug';  // esto es para optimizarlo a nivel de ceo
    }
    
    //relacion muchos a muchos
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
