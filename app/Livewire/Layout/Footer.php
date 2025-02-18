<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Footer extends Component
{

    public $email;

public function subscribe()
{
    // Validar el correo electrónico
    $this->validate([
        'email' => 'required|email',
    ]);

    // Guardar el correo en la base de datos o enviarlo a un servicio de correo
    // Ejemplo: Suscripcion::create(['email' => $this->email]);

    // Mostrar un mensaje de éxito
    session()->flash('message', '¡Gracias por suscribirte!');
    $this->reset('email');
}

    public function render()
    {
        
        return view('livewire.layout.footer');
    }
}
