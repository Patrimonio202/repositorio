<div>
    <div class="flex">
        <figure class="mr-4">
            <img class="w-12 h-12 object-cover object-center rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                alt="">
        </figure>

        <div class="flex-1">
            <form wire:submit.prevent="store">
                <textarea wire:model.defer="message" rows="3"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                    placeholder="Escribe tu mensaje"></textarea>

                <x-input-error for="message" class="mt-1" />

                <div class="flex justify-end">
                    <x-button>
                        {{ __('Comentar') }}
                    </x-button>
                </div>

            </form>
        </div>

    </div>

    <p class="text-lg font-semibold mt-6 mb-4">
        {{$model->questions()->count()}}  Comentarios:
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
                                <textarea wire:model="question_edit.body"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm w-full"></textarea>

                                <x-input-error for="question_edit.body" class="mt-1" />


                                <div class="flex justify-end">
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
                                {{ $question->body }}
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
                                <x-dropdown-link class="cursor-pointer" wire:click="edit({{ $question->id }})">
                                    Editar
                                </x-dropdown-link>

                                <x-dropdown-link class="cursor-pointer" wire:click="destroy({{ $question->id }})">
                                    Eliminar
                                </x-dropdown-link>
                            </x-slot>

                        </x-dropdown>
                    </div>
                </div>
                @livewire('answer', compact('question'), key('answer-' . $question->id))
            </li>
        @endforeach
    </ul>

   @if($model->questions()->count() -$cant>0)
    <div class="flex items-center">
        <hr class="flex-1">
        <button class="text-sm font-semibold text-gray-500 hover:text-gray-600 mx-4"
        wire:click="show_more_question">
            Ver los {{$model->questions()->count() -$cant}} comentarios restantes
        </button>
        <hr class="flex-1">
    </div>

    @endif

</div>
