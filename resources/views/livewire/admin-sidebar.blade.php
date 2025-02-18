<div class="flex flex-col md:flex-row h-screen bg-gray-100">
    <!-- Sidebar responsivo -->
    <div class="hidden md:block md:w-64 bg-blue-900 text-white p-6 space-y-6 rounded-lg shadow-lg">
        <!-- Título -->
        <h2 class="text-xl font-semibold text-white mb-6">
            Panel Administrativo
        </h2>

        <!-- Botones -->
        <button 
            wire:click="setActiveComponent('services')" 
            class="w-full py-3 px-5 rounded-lg flex items-center space-x-3 transition duration-300 
                {{ $activeButton === 'services' ? 'bg-blue-700' : 'bg-blue-800 hover:bg-blue-700' }}">
            <i class="fas fa-calendar text-lg"></i>
            <span>Tus Servicios</span>
        </button>

        <button 
            wire:click="setActiveComponent('awards')" 
            class="w-full py-3 px-5 rounded-lg flex items-center space-x-3 transition duration-300 
                {{ $activeButton === 'awards' ? 'bg-blue-700' : 'bg-blue-800 hover:bg-blue-700' }}">
            <i class="fas fa-trophy text-lg"></i>
            <span>Premios</span>
        </button>

        <button 
            wire:click="setActiveComponent('certificates')" 
            class="w-full py-3 px-5 rounded-lg flex items-center space-x-3 transition duration-300 
                {{ $activeButton === 'certificates' ? 'bg-blue-700' : 'bg-blue-800 hover:bg-blue-700' }}">
            <i class="fas fa-certificate text-lg"></i>
            <span>Certificados</span>
        </button>
    </div>

    <!-- Menú para móviles -->
    <div class="md:hidden p-4 bg-blue-900 text-white">
        <button wire:click="toggleMenu" class="w-full py-3 px-4 rounded-lg bg-blue-700 flex items-center justify-between">
            <span>Menú</span>
            <i class="fas fa-bars text-lg"></i>
        </button>

        <div class="{{ $menuOpen ? 'block' : 'hidden' }} mt-4 space-y-4">
            <button wire:click="setActiveComponent('services')" class="w-full py-3 px-5 rounded-lg bg-blue-700 hover:bg-blue-600">
                <i class="fas fa-calendar text-lg"></i>
                <span>Tus Servicios</span>
            </button>
            <button wire:click="setActiveComponent('awards')" class="w-full py-3 px-5 rounded-lg bg-blue-700 hover:bg-blue-600">
                <i class="fas fa-trophy text-lg"></i>
                <span>Premios</span>
            </button>
            <button wire:click="setActiveComponent('certificates')" class="w-full py-3 px-5 rounded-lg bg-blue-700 hover:bg-blue-600">
                <i class="fas fa-certificate text-lg"></i>
                <span>Certificados</span>
            </button>
        </div>
    </div>

    <!-- Contenido dinámico -->
    <div class="flex-1 p-6">
        <div class="space-y-4">
            <!-- Tabla con scroll horizontal -->
            <div class="overflow-x-auto">
                @if ($activeButton === 'awards')
                    <livewire:provider-awards />
                @elseif ($activeButton === 'certificates')
                    <livewire:upload-certificate />
                @elseif ($activeButton === 'services')
                    <livewire:provider-services />
                @endif
            </div>
        </div>
    </div>
</div>
