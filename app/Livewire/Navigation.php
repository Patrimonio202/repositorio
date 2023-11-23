<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Navigation extends Component
{
    public $colorbanner;

    public function mount()
    {  
      //dd($this->colorbanner); 
    }

    public function render()
    {
         $categories= Category::all();
        return view('livewire.navigation', compact('categories'));
    }
}
