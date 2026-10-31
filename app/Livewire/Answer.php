<?php

namespace App\Livewire;

use App\Models\Answer as ModelsAnswer;
use Livewire\Component;


class Answer extends Component
{
     public $question;

     public $answers;

    public $cant=0;

    public $open=false;


    public $answer_created=[
        'open'=>false,
        'body'=>''
    ];

    public $answer_edit=[
        'id'=>null,
        'body'=>''
    ];

    public $answer_to_answer=[
        'id'=>null,
        'body'=>''
    ];

    // public function getAnswersProperty(){
    //     return $this->question->answers()          
    //       ->get()
    //       -> take($this->cant * (-1));
    // }

     public function boot(){
         $this->getAnswers();
     }

     public function getAnswers(){
         $this->answers= $this->question->answers()          
                ->get()
               -> take($this->cant * (-1));
    //     //take($this->cant)->get();
    }

    public function store(){
        abort_unless(auth()->check(), 403); // seguridad v1.0 (30/10/2026)

        $this->validate([
            'answer_created.body'=>'required'
        ]);

        $this->question->answers()->create([
            'body'=>$this->answer_created['body'],
            'user_id'=>auth()->id()
        ]);

        $this->cant+=1;
               
        $this->reset('answer_created');

        $this->getAnswers();
    }

    public function edit($answerId){

        $answer=ModelsAnswer::find($answerId);
        $this->autorizar($answer); // seguridad v1.0 (30/10/2026)

        $this->answer_edit=[
            'id'=>$answer->id,
            'body'=>$answer->body
        ];
    }

    public function update(){
        $this->validate([
            'answer_edit.body'=>'required'
        ]);

        $answer=ModelsAnswer::find($this->answer_edit['id']);
        $this->autorizar($answer); // seguridad v1.0 (30/10/2026)

        $answer->update([
            'body'=>$this->answer_edit['body']
        ]);

        $this->getAnswers();  
        $this->reset('answer_edit');
    }

    public function destroy($questionId){
        //dd($questionId);
        $answer=ModelsAnswer::find($questionId);
        $this->autorizar($answer); // seguridad v1.0 (30/10/2026)
        
        $answer->delete();
        
         $this->getAnswers(); 
    }

    public function answer_to_answer_store(){
        abort_unless(auth()->check(), 403); // seguridad v1.0 (30/10/2026)
      
        $this->validate([
        'answer_to_answer.body'=>'required'
       ]);

       $answer=$this->question->answers()->create([
        'body'=>$this->answer_to_answer['body'],
        'user_id'=>auth()->id()
       ]);   
       
       $this->reset('answer_to_answer');

       $this->getAnswers();  
       
    }

    public function cancel(){
        $this->reset('answer_edit');
    }

    public function show_answer(){
        if($this->cant< $this->question->answers()->count()){
            $this->cant=$this->question->answers()->count();
        }else{
            $this->cant=0;
        }
        $this->getAnswers();
       // $this->open=!$this->open;       
    }

    // seguridad v1.0 (30/10/2026): solo el autor del comentario o quien puede editar publicaciones
    private function autorizar($modelo): void
    {
        $usuario = auth()->user();
        abort_unless($modelo && $usuario && ((int) $modelo->user_id === (int) $usuario->id || $usuario->can('admin.posts.edit')), 403);
    }

    public function render()
    {
        return view('livewire.answer');
    }
}
