<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Support\HtmlSeguro;

class Post extends Model
{
    use HasFactory;

    protected ?string $cuerpoSeguroMemo = null;
    
    protected $fillable = [
        'name',
        'slug',
        'body',
        'anocreacion',
        'autor',
        'destacada',
        'status',
        'category_id',
        'subcategory_id',
        'tema_id',
    ];

    protected $cats=[
        'created_at'=>'datetime'
    ];

    // cuerpo_seguro v1.0 (30/10/2026): el cuerpo de la publicacion sin codigo peligroso (ver App\Support\HtmlSeguro)
    public function getCuerpoSeguroAttribute(): string
    {
        return $this->cuerpoSeguroMemo ??= HtmlSeguro::limpiar($this->body);
    }

    // resumen v1.1 (30/10/2026): extracto en TEXTO PLANO del cuerpo de la publicacion.
    // Antes se cortaba el HTML a 100 caracteres con Str::limit() y se imprimia sin escapar:
    // si el corte dejaba abiertas etiquetas como <i>, <strong> o <!--, el navegador metia
    // las tarjetas siguientes dentro de ellas y la cuadricula se descuadraba.
    public function resumen(int $limite = 100, string $fin = '...'): string
    {
        // v1.1: las etiquetas de bloque (p, br, div...) se cambian por un espacio para que los parrafos no queden pegados
        $html = preg_replace('~</?(?:p|br|div|li|ul|ol|h[1-6]|blockquote|tr|td|th|table|figure|figcaption)\b[^>]*>~i', ' ', (string) $this->body);
        $texto = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $texto = trim(preg_replace('/\s+/u', ' ', $texto));
        return Str::limit($texto, $limite, $fin);
    }

    //relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion category de uno a muchos
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //relacion subcategory de uno a muchos 
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
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
          })->when($filters['fdesde'] ?? null && $filters['fhasta'] ?? null, function($query ) use($filters) { 
             $query->whereBetween('anocreacion', [$filters['fdesde'], $filters['fhasta']]);
          });
    }

    //filter etiquetas t
    public function scopeFiltert($query, $filters){ 
        $query ->when($filters['subcategorias'] ?? null, function($query, $subcategorias){
            $query->whereIn('subcategory_id', $subcategorias);
          })->when($filters['fdesde'] ?? null && $filters['fhasta'] ?? null, function($query ) use($filters) { 
            $query->whereBetween('anocreacion', [$filters['fdesde'], $filters['fhasta']]);
         })->when($filters['categorias'] ?? null, function($query, $categorias){
            $query->whereIn('category_id', $categorias);
          })->when($filters['autores'] ?? null, function($query, $autor){
            $query->whereIn('autor', $autor);
          })->when($filters['temas'] ?? null, function($query, $tema){
            $query->whereIn('tema_id', $tema);
          });
    }

}
