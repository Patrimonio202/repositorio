<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

// rendimiento v1.0 (30/10/2026): se carga en una sola peticion (antes: lazy + wire:init hacian dos)
class DestacadaPosts extends Component
{
    public function placeholder()
    {
        return <<<'HTML'
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
        </div>
        HTML;
    }

    public function render()
    {
        $tags = Tag::where('coleccion', 2)->limit(4)->get();

        return view('livewire.destacada-posts', compact('tags'));
    }
}
