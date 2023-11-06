<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $guarded=['id', 'created_at', 'updated_at'];
    //relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion category de uno a muchos
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    //relacion tema de uno a muchos
    public function tema(){
        return $this->belongsTo(Tema::class);
    }

   //relacion muchos a muchos
   public function tags(){
       return $this->belongsToMany(Tag::class);
   }

   //relacion uno a uno polimorfica
   public function image(){
       return $this->morphOne(Image::class, 'imageable');
   }

   //relacion uno a muchos votos me encanta
   public function votes()
   {
       return $this->hasMany(Vote::class);
   } 

   //este es para ver los votos de me interesa
   public function userVotes()
   {
       return $this->votes()->one()->where('user_id', auth()->id())->where('voto',2);
   } 

   //este es para ver los votos like
   public function userVoteslike()
   {
       return $this->votes()->one()->where('user_id', auth()->id())->where('voto',1);
   } 

   // relacion uno a muchas polimorficas
   public function questions(){
    return $this->morphMany(Question::class,'questionable');
   }

}
