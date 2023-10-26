<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name'=>'Imágenes', 
            'slug'=>Str::slug('Imágenes')
        ]); 
        Category::create([
            'name'=>'Audios', 
            'slug'=>Str::slug('Audios')
        ]); 
        Category::create([
            'name'=>'Libros', 
            'slug'=>Str::slug('Libros')
        ]); 
        Category::create([
            'name'=>'Videos', 
            'slug'=>Str::slug('Videos')
        ]); 
    }
}
