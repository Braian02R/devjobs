<form action="" class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante'>
    <!-- Titulo de vacante -->
    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        <x-text-input 
            id="titulo" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="titulo" 
            :value="old('titulo')" 
            placeholder="Titulo Vacante"
        />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2 uppercase border border-red-500 font-bold  text-sm" />
    </div>

    <!-- Salario Mensual-->
    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select
            id="salario" 
            wire:model="salario"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm"   
        >
            <option>-- Seleccione --</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('salario')" class="mt-2 uppercase border border-red-500 font-bold  text-sm" />
    </div>

    <!-- Categoría -->
    <div>
        <x-input-label for="categoria" :value="__('Categoría')" />
        <select
            id="categoria" 
            wire:model="categoria"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm"   
        >
            <option>-- Seleccione --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                @endforeach
        </select>
        <x-input-error :messages="$errors->get('categoria')" class="mt-2 uppercase border border-red-500 font-bold  text-sm" />
    </div>

    <!-- Nombre de empresa -->
    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input 
            id="empresa" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="empresa" 
            :value="old('empresa')" 
            placeholder="Empresa: ej. Netflix, Uber, Shopify"
        />
        <x-input-error :messages="$errors->get('empresa')" class="mt-2 uppercase border border-red-500 font-bold  text-sm" />
    </div>

    <!-- fecha de ultima dia para postularse -->
    <div>
        <x-input-label for="ultimo_dia" :value="__('Último Día para postularse')" />
        <x-text-input 
            id="ultimo_dia" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="ultimo_dia" 
            :value="old('ultimo_dia')" 
        />
        <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2 uppercase border border-red-500 font-bold  text-sm" />
    </div>

    <!-- Descripción -->
    <div>
        <x-input-label for="descripcion" :value="__('Descripción Puesto')" />
        <textarea 
            wire:model="descripcion"
            placeholder="Descripción general del puesto, experiencia"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm h-72"
        ></textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2 uppercase border border-red-500 font-bold  text-sm" />
    </div>

    <!-- Imagen -->
    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input 
            id="imagen" 
            class="block mt-1 w-full" 
            type="file" 
            wire:model="imagen_nueva"
            accept="image/*"
        />

        <div class="my-5 w-80">
            <x-input-label :value="__('Imagen Actual')" />

            <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'Imagen Vacante ' . $titulo }}">
        </div>

        <div class="my-5 w-80">
            @if ($imagen_nueva)
                Imagen Nueva:
                <img src="{{ $imagen_nueva->temporaryUrl() }}" alt="">
            @endif
        </div>

        <x-input-error :messages="$errors->get('imagen_nueva')" class="mt-2 uppercase border border-red-500 font-bold  text-sm" />
    </div>

    <x-primary-button>
        Guardar Cambios
    </x-primary-button>
</form>
