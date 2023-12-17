<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $guarded=['id', 'created_at', 'updated_at'];

    protected $cats=[
        'created_at'=>'datetime'
    ];

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

   public function getRouteKeyName()
    {
         return 'slug';  // esto es para optimizarlo a nivel de ceo
    }

    public function scopeFilter($query, $filters){
        $query ->when($filters['category'] ?? null, function($query, $category){
            $query->whereIn('category_id', $category);
          })->when($filters['order'] ?? 'new', function($query,$order) {
             $sort= $order === 'new' ? 'desc' : 'asc';
             $query->orderBy('created_at',$sort);
          })->when($filters['tag'] ?? null, function($query,$tag){
            $query->whereHas('tags', function($query) use ($tag) {
                $query->where('tags.name',$tag);
            });
          })->when($filters['textobuscar'] ?? null, function($query,$textobuscar){   
            $query->where( function($query)  use ($textobuscar){
                $query->where('name','like','%'. $textobuscar.'%')
                  ->orWhere('body','like','%'. $textobuscar.'%')
                  ->orWhere('autor','like','%'. $textobuscar.'%');
            });

          })->when($filters['colecciones'] ?? null, function($query,$tag){
            $query->whereHas('tags', function($query) use ($tag) {
                $query->where('tags.id',$tag);
            });
          });
    }

    //filter categorias
    public function scopeFilterc($query, $filters){ 
        $query ->when($filters['tag'] ?? null, function($query,$tag){
            $query->whereHas('tags', function($query) use ($tag) {
                $query->where('tags.name',$tag);
            });
          })->when($filters['colecciones'] ?? null, function($query,$tag){
            $query->whereHas('tags', function($query) use ($tag) {
                $query->where('tags.id',$tag);
            });
          })->when($filters['autores'] ?? null, function($query, $autor){
            $query->whereIn('autor', $autor);
          })->when($filters['temas'] ?? null, function($query, $tema){
            $query->whereIn('tema_id', $tema);
          })->when($filters['fdesde'] && $filters['fhasta'] ?? null, function($query ) use($filters) { 
             $query->whereBetween('created_at', [$filters['fdesde'], $filters['fhasta']]);
          });
    }

}
