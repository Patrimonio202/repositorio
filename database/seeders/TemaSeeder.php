<?php

namespace Database\Seeders;

use App\Models\Tema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tema::create([
            'name'=>'Arte',
            'slug'=>Str::slug('Arte')            
        ]);

        Tema::create([
            'name'=>'Cultura',
            'slug'=>Str::slug('Cultura')            
        ]);

        Tema::create([
            'name'=>'Patrimonio',
            'slug'=>Str::slug('Patrimonio')            
        ]);
    }
}
