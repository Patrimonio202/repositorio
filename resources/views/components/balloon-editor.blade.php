@props(['focus'=>false,'placeholder'=>'Agrega un texto' ])

<div class="border-b" wire:ignore x-data="{
    message:@entangle( $attributes->wire('model'))  ,
    isFocus: false,          
}" x-init="
    $watch('message', value=>{
       if(value==''){
        balloonEditor.setData('');
       }
    })


    BalloonEditor
    .create($refs.myEditor,{
        placeholder: '{{$placeholder}}',

    }).then(editor=>{

        balloonEditor=editor;

        if(message){
            editor.setData(message);
        }    
        
        @if($focus)
            editor.focus();
            {{-- isFocus=true; --}}
        @endif

        editor.model.document.on('change:data', ()=>{
            message=editor.getData();
        })

        editor.editing.view.document.on('change:isFocused', (evt, data, isFocused) => {
            if (isFocused) {
                isFocus = true;
            } else {
                isFocus = false;
            }
        });

    })

    .catch(error => {
        console.error(error);
    }); ">
    <div x-ref="myEditor" x-bind:class="isFocus ? 'bg-white' : '' " ></div>
</div>