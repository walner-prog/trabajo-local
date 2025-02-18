<?php

namespace App\Livewire;

use Livewire\Component;

class AdminSidebar extends Component
{
    public $activeButton = 'services'; // Estado inicial
    public $menuOpen = false;

    // Cambiar componente activo
    public function setActiveComponent($component)
    {
        $this->activeButton = $component;
    }
    public function toggleMenu()
    {
        $this->menuOpen = !$this->menuOpen;
    }

    public function render()
    {
        return view('livewire.admin-sidebar');
    }
}