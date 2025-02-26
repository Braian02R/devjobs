<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($vacantes as $vacante)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="space-y-4">
                    <a href="{{route('vacantes.show', $vacante->id)}}" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>

                    <p class="text-sm text-gray-600 font-bold"> {{$vacante->empresa}} </p>
                    <p class="text-sm text-gray-500">Último día: {{$vacante->ultimo_dia->format('d/m/Y')}} </p>
                </div>

                <div class="flex flex-col items-stretch md:flex-row gap-3 mt-5 md:mt-0">
                    <a 
                        href="{{ route('candidatos.index', $vacante) }}"
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs 
                        font-bold uppercase text-center"
                    >
                    {{ $vacante->candidatos->count()}} Candidatos</a>
                    <a 
                        href="{{ route('vacantes.edit', $vacante->id) }}"
                        class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs 
                        font-bold uppercase text-center"
                    >Editar</a>
                    <button 
                        wire:click="$emit('mostrarAlerta', {{ $vacante->id }})"
                        class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs 
                        font-bold uppercase text-center"
                    >Eliminar</button>
                </div>
            </div>
        @empty
            <p class="text-gray-600 text-center text-sm p-5">No hay vacantes que mostrar</p>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>
</div>

@push('scripts')
    {{-- <script>
        alert('hola mundo')
    </script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('mostrarAlerta', (vacanteId) => {
            // alert('Desde el código de javascript, vacante_id: ' + vacanteId)
            Swal.fire({
                title: '¿Eliminar Vacante?',
                text: "Una vacante eliminada no se puede recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, ¡Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Elimnar la vacante
                    Livewire.emit('eliminarVacante', vacanteId)

                    Swal.fire(
                    'Se eliminó la Vacante!',
                    'Eliminado Correctamente.',
                    'success'
                    )
                }
            })
        })
    </script>
@endpush