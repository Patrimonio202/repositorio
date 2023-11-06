<?php

namespace App\Livewire;

use Livewire\Component;
use app\Models\Question as ModelsQuestion;

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

        $question->update([
            'body' => $this->question_edit['body']
        ]);

        $this->getQuestions();  // este es para mostrar la lista despues de actualizar

        $this->reset('question_edit');
    }

    public function destroy($questionId)
    {
        $question = ModelsQuestion::find($questionId);
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

    public function render()
    {
        return view('livewire.question');
    }
}
