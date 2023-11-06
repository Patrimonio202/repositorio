<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable=['body', 'user_id'];

    public function questionable(){
        return $this->morphTo();
    }

     //relacion uno a muchos inversa
     public function user(){
        return $this->belongsTo(User::class);
     }

     //relacion uno a muchos
     public function answers(){
        return $this->hasMany(Answer::class);
     }
}
