<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question as ModelsQuestion;

class Question extends Component
{
    public $model;  // modelo que se recibe desde el formulario
    public $message;
    
    public $questions;

    public $cant = 10;

    public $question_edit = [
        'id' => null,
        'body' => ''
    ];
    

    public function boot()
     {
        $this->getQuestions();
     }

    //  public function getQuestionsProperty()
    //  {
    //      return   $this->model
    //          ->questions()
    //          ->orderBy('created_at', 'desc')
    //          ->take($this->cant)
    //          ->get();
    //  }

     public function getQuestions()
     {
         $this->questions = $this->model
             ->questions()
             ->orderBy('created_at', 'desc')
            ->take($this->cant)
            ->get();
     }

    public function store()
    {
        abort_unless(auth()->check(), 403); // seguridad v1.0 (30/10/2026)
        $this->validate([
            'message' => 'required'
        ]);

        $this->model->questions()->create([
            'body' => $this->message,
            'user_id' => auth()->id()
        ]);

       $this->getQuestions();
        $this->message = '';
    }

    // con este guardamos la informacion de la pregunta y la mostramos en un textarea
    public function edit($questionId)
    {
       // dd($questionId);
        $question = ModelsQuestion::find($questionId);
        $this->autorizar($question); // seguridad v1.0 (30/10/2026)
        $this->question_edit = [
            'id' => $question->id,
            'body' => $question->body
        ];
    }

    public function update()
    {
        $this->validate([
            'question_edit.body' => 'required'
        ]);

        $question = ModelsQuestion::find($this->question_edit['id']);
        $this->autorizar($question); // seguridad v1.0 (30/10/2026)

        $question->update([
            'body' => $this->question_edit['body']
        ]);

        $this->getQuestions();  // este es para mostrar la lista despues de actualizar

        $this->reset('question_edit');
    }

    public function destroy($questionId)
    {
        $question = ModelsQuestion::find($questionId);
        $this->autorizar($question); // seguridad v1.0 (30/10/2026)
        $question->delete();
        $this->getQuestions();
        $this->reset('question_edit');
    }

    public function cancel()
    {
        $this->reset('question_edit');
    }

    public function show_more_question()
    {
        $this->cant += 10;
        $this->getQuestions();
    }

    // seguridad v1.0 (30/10/2026): solo el autor del comentario o quien puede editar publicaciones
    private function autorizar($modelo): void
    {
        $usuario = auth()->user();
        abort_unless($modelo && $usuario && ((int) $modelo->user_id === (int) $usuario->id || $usuario->can('admin.posts.edit')), 403);
    }

    public function render()
    {
        return view('livewire.question');
    }
}
