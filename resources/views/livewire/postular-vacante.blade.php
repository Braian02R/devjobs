<div>
    <div class="bg-gray-100 p-5 mt-10 flex flex-col justify-center items-center">
        <h3 class="text-center text-2xl font-bold my-4">Postularme a esta vacante</h3>

        {{-- Mostrar mensaje de éxito --}}
        @if (session()->has('mensaje'))
            <p class="uppercase border border-green-500 bg-green-100 text-green-600 font-bold p-2 my-5 text-sm rounded-lg">
                {{ session('mensaje') }}
            </p>
        @endif

        {{-- Mostrar mensaje de error --}}
        @if (session()->has('error'))
            <p class="uppercase border border-red-500 bg-red-100 text-red-600 font-bold p-2 my-5 text-sm rounded-lg">
                {{ session('error') }}
            </p>
        @endif

        {{-- Formulario de postulación --}}
        @if (!session()->has('mensaje') && !session()->has('error'))
            <form class="w-96 mt-5" wire:submit.prevent="postularme">
                <div class="mb-4">
                    <x-input-label for="cv" :value="__('Curriculum o Hoja de Vida (PDF)')" />
                    <x-text-input id="cv" type="file" wire:model="cv" accept=".pdf" class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('cv')" class="mt-2 uppercase border border-red-500 font-bold text-sm" />
                    <x-primary-button class="my-5">
                        {{ __('Postularme') }}
                    </x-primary-button>
                </div>
            </form>
        @endif
    </div>
</div>