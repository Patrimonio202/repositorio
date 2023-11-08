<div class="pl-16">
    @auth
        <button wire:click="$set('answer_created.open', true)">
            <i class="fa-solid fa-reply"></i>
            Responder
        </button>

        @if ($answer_created['open'])
            <div class="flex">
                <figure class="mr-4">
                    <img class="w-12 h-12 object-cover object-center rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                        alt="">
                </figure>

                <form class="flex-1" wire:submit="store()">
                    {{-- <textarea wire:model="answer_created.body"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                    placeholder="Escriba su respuesta"></textarea> --}}

                    <x-balloon-editor wire:model="answer_created.body" placeholder="Escriba su respuesta" />

                    <x-input-error for="answer_created.body" class="mt-1" />


                    <div class="flex justify-end mt-4">
                        <x-danger-button class="mr-2" wire:click="$set('answer_created.open', false)">
                            Cancelar
                        </x-danger-button>

                        <x-button>
                            Responder
                            </x-danger-button>
                    </div>
                </form>
            </div>
        @endif
    @endauth

    @if ($question->answers()->count())
        <div class="mt-2">
            <button class="font-semibold text-blue-500" wire:click="show_answer">
                @if ($this->cant < $this->question->answers()->count())                   
                    <span wire:loading.remove="" wire:target="show_answer">
                        <i class="fas fa-angle-down mr-1"></i> 
                        Mostrar las {{ $question->answers()->count() }} respuestas
                    </span>                    
                @else                    
                    <span wire:loading.remove="" wire:target="show_answer">
                        <i class="fas fa-angle-up mr-1"></i> 
                        Ocultar {{ $question->answers()->count() }} respuestas
                    </span>
                @endif
                <span wire:loading="" wire:target="show_answer">
                    <div class="flex">
                        <div class="w-4 h-4 rounded-full animate-pulse bg-gray-500"></div>
                        <div class="w-4 h-4 rounded-full animate-pulse bg-gray-500 mx-2"></div>
                        <div class="w-4 h-4 rounded-full animate-pulse bg-gray-500"></div>
                    </div>
                </span>
            </button>
        </div>
    @endif


    <ul class="space-y-6 mt-4">
        @foreach ($this->answers as $answer)
            <li wire:key="answer-{{ $answer->id }}">
                <div class="flex">
                    <figure class="mr-4">
                        <img class="w-12 h-12 object-cover object-center rounded-full"
                            src="{{ $answer->user->profile_photo_url }}" alt="">
                    </figure>

                    <div class="flex-1">
                        <p class="font-semibold">
                            {{ $answer->user->name }}

                            <span class="text-sm font-normal">
                                {{ $answer->created_at->diffforHumans() }}
                            </span>
                        </p>

                        @if ($answer->id == $answer_edit['id'])
                            <form wire:submit="update()">
                                {{-- <textarea wire:model="answer_edit.body"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm w-full"></textarea> --}}

                                <x-balloon-editor wire:model="answer_edit.body" :focus="true" />
                                <x-input-error for="answer_edit.body" class="mt-1" />


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
                                {!! $answer->body !!}
                            </p>

                            <button wire:click="$set('answer_to_answer.id',{{ $answer->id }})">
                                <i class="fa-solid fa-reply"></i>
                                Responder
                            </button>
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
                                    <x-dropdown-link class="cursor-pointer" wire:click="edit({{ $answer->id }})">
                                        <i class="fas fa-edit inline-block w-5"></i>
                                        Editar
                                    </x-dropdown-link>

                                    <x-dropdown-link class="cursor-pointer" wire:click="destroy({{ $answer->id }})">
                                        <i class="fas fa-trash inline-block w-5"></i>
                                        Eliminar
                                    </x-dropdown-link>
                                @endauth
                                <x-dropdown-link class="cursor-pointer">
                                    <i class="fas fa-flag inline-block w-5"></i>
                                    Reportar
                                </x-dropdown-link>
                            </x-slot>


                        </x-dropdown>
                    </div>


                </div>
                @if ($answer_to_answer['id'] == $answer->id)
                    <div class="flex mt-4">
                        <figure class="mr-4">
                            <img class="w-12 h-12 object-cover object-center rounded-full"
                                src="{{ $answer->user->profile_photo_url }}" alt="">
                        </figure>

                        <div class="flex-1">
                            <form wire:submit="answer_to_answer_store">
                                {{-- <textarea wire:model="answer_to_answer.body"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                                    placeholder="Ingrese una respuesta"></textarea> --}}

                                <x-balloon-editor wire:model="answer_to_answer.body"
                                    placeholder="Ingrese una respuesta" />

                                <x-input-error for="answer_to_answer.body" class="mt-1" />


                                <div class="flex justify-end mt-4">
                                    <x-danger-button class="mr-2" wire:click="$set('answer_to_answer.id',null)">
                                        Cancelar
                                    </x-danger-button>

                                    <x-button>
                                        Responder
                                        </x-danger-button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</div>
