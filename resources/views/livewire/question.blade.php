<div>
   
        <div class="flex">
            <figure class="mr-4">
                @auth 
                       <img class="w-12 h-12 object-cover object-center rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                        alt="">
                @else
                       <svg class="w-12 h-12 object-cover object-center rounded-full"  xmlns="http://www.w3.org/2000/svg" height="1em" 
                                    viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> 
                            
                  @endauth
            </figure>

            <div class="flex-1">
                <form wire:submit.prevent="store">
                    {{-- <textarea wire:model.defer="message" rows="3"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                        placeholder="Escribe tu mensaje"></textarea> --}}
                    
                    <x-balloon-editor wire:model="message" placeholder="Agrega un comentario"  />                    

                    <x-input-error for="message" class="mt-1" />
                    @auth   
                        <div class="flex justify-end mt-4">
                            <x-button>
                                {{ __('Comentar') }}
                            </x-button>
                        </div>
                    @endauth

                </form>
            </div>

        </div>
   
    <p class="text-lg font-semibold mt-6 mb-4">
        {{ $model->questions()->count() }} Comentarios:
    </p>

    <ul class="space-y-6">
        @foreach ($this->questions as $question)
            <li wire:key="question-{{ $question->id }}">
                <div class="flex">
                    <figure class="mr-4">
                        <img class="w-12 h-12 object-cover object-center rounded-full"
                            src="{{ $question->user->profile_photo_url }}" alt="">
                    </figure>

                    <div class="flex-1">
                        <p class="font-semibold">
                            {{ $question->user->name }}

                            <span class="text-sm font-normal">
                                {{ $question->created_at->diffforHumans() }}
                            </span>
                        </p>
                        @if ($question->id == $question_edit['id'])
                            <form wire:submit="update()">
                                {{-- <textarea wire:model="question_edit.body"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm w-full"></textarea> --}}

                                <x-balloon-editor wire:model="question_edit.body" :focus="true" />    

                                <x-input-error for="question_edit.body" class="mt-1" />


                                <div class="flex justify-end mt-4">
                                    <x-danger-button class="mr-2" wire:click="cancel">
                                        Cancelar
                                    </x-danger-button>

                                    <x-button>
                                        Actualizar
                                        </x-danger-button>
                                </div>
                            </form>
                        @else
                            <p>
                                {!! $question->body !!}
                            </p>
                        @endif
                    </div>

                    <div class="ml-6">
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @auth
                                @if(Auth::user()->id== $question->user_id)
                                    <x-dropdown-link class="cursor-pointer" wire:click="edit({{ $question->id }})">
                                    <i  class="fas fa-edit inline-block w-5" ></i>
                                        Editar
                                    </x-dropdown-link>

                                    <x-dropdown-link class="cursor-pointer" wire:click="destroy({{ $question->id }})">
                                        <i class="fas fa-trash inline-block w-5" ></i>
                                        Eliminar
                                    </x-dropdown-link>
                                @endif
                                @endauth
                                <x-dropdown-link class="cursor-pointer" >
                                    <i class="fas fa-flag inline-block w-5"></i>
                                    Reportar
                                </x-dropdown-link>
                            </x-slot>

                        </x-dropdown>
                    </div>
                </div>
                @livewire('answer', compact('question'), key('answer-' . $question->id))
            </li>
        @endforeach
    </ul>

    @if ($model->questions()->count() - $cant > 0)
        <div class="flex items-center">
            <hr class="flex-1">
            <button class="text-sm font-semibold text-gray-500 hover:text-gray-600 mx-4"
                wire:click="show_more_question">
                Ver los {{ $model->questions()->count() - $cant }} comentarios restantes
            </button>
            <hr class="flex-1">
        </div>
    @endif

    @push('js')
        <script src="{{ asset('vendor/ckeditor5-build-balloon/build/ckeditor.js') }}"></script>
        
    @endpush

</div>
