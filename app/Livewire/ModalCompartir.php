<?php

namespace App\Livewire;

use Livewire\Component;

class ModalCompartir extends Component
{
    public $post;  // con este recibimos la vista
    public $open=true;
    public function render()
    {
        return view('livewire.modal-compartir');
    }
}
