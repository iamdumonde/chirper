<x-app-layout>
    <a href="{{ route('change.language', 'fr') }}">french</a>
    <a href="{{ route('change.language', 'en') }}">english</a>

    {{-- Component alerte --}}
    <x-alert :color="'bg-yellow-500'" :message="'Vous n\'avez pas saisi le nom d\'utilisateur'" />
    <x-alert :color="'bg-indigo-700'" :message="'Ce champ est requis'" />
    
    {{-- Component Card --}}
    <x-card>
        <h3>Titre de la carte n*1</h3>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum excepturi facere soluta ea, quod nemo suscipit,
            cumque incidunt beatae, natus saepe velit sed.
        </p>
    </x-card>
    <x-card>
        <h3>Titre de la carte n*2</h3>
        <img src="https://unsplash.it/300/200" alt="image">
    </x-card>

    <p> {{ route('chirps.index') }}</p>
    <p> {{ route('chirps.store') }}</p>
    {{-- <p> {{action(ChirpController::class, 'index')}}</p> --}}
    <p> {{ url('profile/user') }}</p>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <form action="{{ route('chirps.store') }}" method="POST">
            @csrf
            <textarea name="message" placeholder="{{ __('util.msg') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>

            <x-input-error :messages="$errors->get('message')" class="mt-2" />

            <x-primary-button class="mt-4">
                {{ __('util.chirp') }}
            </x-primary-button>
        </form>

        {{-- <pre>
            {{ $chirps }}
        </pre> --}}
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y divide-solid divide-gray-500">
            @foreach ($chirps as $chirp)
                <div class="p-6 flex space-x-2">
                    <svg class="h-6 w-6 text-dark-600 -scale-x-100" xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                        <path
                            d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        <path
                            d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">
                                    {{ $chirp->user->name }}
                                </span>
                                <small class="ml-2 text-sm text-gray-600">
                                    {{ $chirp->created_at->format('j M Y, g:i a') }}
                                </small>
                                {{-- eq = equals --}}
                                @php
                                    
                                @endphp
                                @if (!$chirp->created_at->eq($chirp->updated_at))
                                    <small class="text-gray-500 text-sm ">Modified {{ $chirp->updated_at->diffforHumans() }}</small>
                                @endif
                            </div>
                            {{-- ne s'affiche que pour les commentaires de l'utilisateur --}}
                            @if ($chirp->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg class="h-6 w-6 text-dark-500" xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-pencil"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>

                                        <form action="{{ route('chirps.destroy', $chirp) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(), this.closest('form').submit()">
                                                {{ __('Supprimer') }}
                                            </x-dropdown-link>
                                   

                                            {{-- <button class='block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out':href="route('chirps.destroy', $chirp)">
                                                {{ __('Supprimer') }}
                                            </button> --}}
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-900">
                            {{ $chirp->message }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</x-app-layout>
