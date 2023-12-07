<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class PostIndex extends Component
{
    use WithPagination;

    protected $paginationTheme="bootstrap";


    public $search; //Variable para sincronizar un imput en la vista

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        // $posts=Post::where('user_id', auth()->user()->id)
        //             ->where('name','LIKE','%'.$this->search.'%')
        //             ->latest('id')
        //             ->paginate(5);
        $posts=Post::where('name','LIKE','%'.$this->search.'%')
                    ->orWhere('body', 'like', '%'.$this->search.'%')
                    ->orWhere('anocreacion', 'like', '%'.$this->search.'%')
                    ->orWhere('autor', 'like', '%'.$this->search.'%')
                   ->latest('id')
                   ->paginate(50);
        return view('livewire.admin.post-index',compact('posts'));
    }
}
