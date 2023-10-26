<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //randomElement(['red','yellow', 'green', 'blue', 'indigo', 'purple', 'pink'])
        Tag::create([
            'name'=>'Archivo Antonio Botero',
            'slug'=>Str::slug('Archivo Antonio Botero'),
            'color'=>'red'
        ]);

        Tag::create([
            'name'=>'Archivo El Santuariano',
            'slug'=>Str::slug('Archivo El Santuariano'),
            'color'=>'yellow'
        ]);

        Tag::create([
            'name'=>'Archivo SMP',
            'slug'=>Str::slug('Archivo SMP'),
            'color'=>'green'
        ]);

        Tag::create([
            'name'=>'Archivo Patrimonial de El Santuario',
            'slug'=>Str::slug('Archivo Patrimonial de El Santuario'),
            'color'=>'blue'
        ]);

        Tag::create([
            'name'=>'Biblioteca Pública Municipal',
            'slug'=>Str::slug('Biblioteca Pública Municipal'),
            'color'=>'indigo'
        ]);

        Tag::create([
            'name'=>'Casa de la Cultura',
            'slug'=>Str::slug('Casa de la Cultura'),
            'color'=>'purple'
        ]);

        Tag::create([
            'name'=>'Escuela de Música',
            'slug'=>Str::slug('Escuela de Música'),
            'color'=>'pink'
        ]);

        Tag::create([
            'name'=>'Escuela de Bellas Artes',
            'slug'=>Str::slug('Escuela de Bellas Artes'),
            'color'=>'red'
        ]);

        Tag::create([
            'name'=>'Centro de Historia',
            'slug'=>Str::slug('Centro de Historia'),
            'color'=>'yellow'
        ]);

        Tag::create([
            'name'=>'Vigías del Patrimonio',
            'slug'=>Str::slug('Vigías del Patrimonio'),
            'color'=>'green'
        ]);

        Tag::create([
            'name'=>'Secretaría de Cultura',
            'slug'=>Str::slug('Secretaría de Cultura'),
            'color'=>'blue'
        ]);

    }
}
