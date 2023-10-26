<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;
    protected $fillable=['name', 'slug'];
    
    public function getRouteKeyName()
    {
         return 'slug';  // esto es para optimizarlo a nivel de ceo
    }

    
     //relacion uno a muchos
     public function posts(){
        return $this-> hasMany(Post::class);
    }
}
