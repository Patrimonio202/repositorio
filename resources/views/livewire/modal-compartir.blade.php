<div>
    <i id='modal-{{$post->id}}' wire:click="$set('open', true)" class="fa-solid fa-share-nodes fa-lg"></i>

    {{-- prueba de modal --}}
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Compartir
        </x-slot>

        <x-slot name="content">
            <div>

            </div>
            <div>
                <x-input class=" w-full px-2 h-7" value="{{$post->body}}"> </x-input>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>

    </x-dialog-modal>

</div>
