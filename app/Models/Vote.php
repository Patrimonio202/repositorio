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

    //relacion muchos a muchos
    public function posts(){
        return $this->belongsToMany(Post::class);
    }

}
