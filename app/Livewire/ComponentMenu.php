<?php

namespace App\Livewire;

use Livewire\Component;

class ComponentMenu extends Component
{
    public $activeButton = 'services'; // Estado inicial
    public $menuOpen = false;
    // Cambiar componente activo
    public function setActiveComponent($component)
    {
        $this->activeButton = $component; // Actualiza el botón activo
        $this->menuOpen = false;
    }

    public function toggleMenu()
    {
        $this->menuOpen = !$this->menuOpen;
    }

    public function render()
    {
        return view('livewire.component-menu');
    }
}
