<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{   
    use WithFileUploads;

    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        //dd($vacante);
        $this->vacante = $vacante;

        // Verificar si el usuario ya se postuló
        if ($this->vacante->candidatos()->where('user_id', auth()->user()->id)->exists()) {
            session()->flash('error', 'Ya te has postulado a esta vacante.');
        }
    }

    public function postularme()
    {
        // Validar que el usuario no haya postulado a la vacante
        if ($this->vacante->candidatos()->where('user_id', auth()->user()->id)->exists()) {
            session()->flash('error', 'Ya te has postulado a esta vacante.');
            return redirect()->back();
        }
        
        $datos = $this->validate();

        // Almacenar CV en el disco duro
        $cv = $this->cv->store('public/cv');
        // $nombre_imagen = str_replace('public/vacantes/', '', $imagen);
        $datos['cv'] = str_replace('public/cv/', '', $cv);

        // Crear el candidato a la vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv']
        ]);

        // Crear la notificación y enviar email

        // Mostrar el usuario un mensaje de ok
        session()->flash('mensaje', 'Se envió correctamente tu información, mucha suerte');

        return redirect()->back();

    }
    
    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
