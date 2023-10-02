<x-app-layout>
    <a href="{{ route('change.language', 'fr') }}">french</a>
    <a href="{{ route('change.language', 'en') }}">english</a>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <form action="{{ route('chirps.update', $chirp) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <textarea name="message" placeholder="{{ __('util.msg') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message', $chirp->message) }}</textarea>

            <x-input-error :messages="$errors->get('message')" class="mt-2" />

            <x-primary-button class="mt-4">
                {{ __('Mettre à jour') }}
            </x-primary-button>
            <a href="{{ route('chirps.index') }}">{{ __('Annuler') }}</a>
        </form>
    </div>

</x-app-layout>
