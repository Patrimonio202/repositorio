<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class Navigation extends Component
{
    public $colorbanner;

    public function mount()
    {  
      //dd($this->colorbanner); 
    }

    public function render()
    {
         $categories = Cache::remember('navigation.categories', now()->addMinutes(30), fn () => Category::all());
        return view('livewire.navigation', compact('categories'));
    }
}
