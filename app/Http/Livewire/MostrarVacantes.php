<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarVacantes extends Component
{   
    // Ejemplo de conectar la vista con este componente con parametros //
    // protected $listeners = ['prueba'];

    // public function mostrarAlerta($vacante_id)
    // {
    //     //dd('Desde mostrarAlerta');
    //     //dd($vacante_id);
    // }


    protected $listeners = ['eliminarVacante'];

    use WithPagination;

    public function eliminarVacante( Vacante $vacante )
    {
        //dd('Eliminando...');
        //dd('$id');
        //dd($vacante);
        $vacante->delete();

    }


    public function render()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(10);
        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes,
        ]);
    }
}
