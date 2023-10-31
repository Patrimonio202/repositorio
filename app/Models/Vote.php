<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id' ,
        'voto'      
    ];

    public function getRouteKeyName()
    {
         return 'slug';  // esto es para optimizarlo a nivel de ceo
    }  

    //relacion muchos a muchos
    public function posts(){
        //return $this->belongsToMany(Post::class);
        return $this->belongsTo(Post::class);
    }     

}
