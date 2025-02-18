<div class="">
    <!-- Card horizontal con los botones de navegación -->
    <div class="ml-1 mr-1 dark:bg-slate-300 p-4 rounded-lg shadow-md mb-6">
    
        <div class="hidden md:flex space-x-4">
            <!-- Botón de Eventos -->
            <button 
                wire:click="setActiveComponent('services')" 
                class="py-2 px-4 rounded-md text-white 
                    {{ $activeButton === 'services' ? 'bg-blue-800' : 'bg-blue-600 hover:bg-blue-700' }} 
                    transition duration-200 flex items-center space-x-2"
            >
                <i class="fas fa-calendar h-5 w-5"></i>
                <span>Tus Servicios</span>
            </button>
        
            <!-- Botón de Premios -->
            <button 
                wire:click="setActiveComponent('awards')" 
                class="py-2 px-4 rounded-md text-white 
                    {{ $activeButton === 'awards' ? 'bg-blue-800' : 'bg-blue-600 hover:bg-blue-700' }} 
                    transition duration-200 flex items-center space-x-2"
            >
                <i class="fas fa-trophy h-5 w-5"></i>
                <span>Premios</span>
            </button>
        
            <!-- Botón de Certificados -->
            <button 
                wire:click="setActiveComponent('certificates')" 
                class="py-2 px-4 rounded-md text-white 
                    {{ $activeButton === 'certificates' ? 'bg-blue-800' : 'bg-blue-600 hover:bg-blue-700' }} 
                    transition duration-200 flex items-center space-x-2"
            >
                <i class="fas fa-certificate h-5 w-5"></i>
                <span>Certificados</span>
            </button>

        
            
        </div>
    
        <!-- Menú para pantallas pequeñas (dropdown) -->
        <div class="md:hidden">
            <button 
                wire:click="toggleMenu" 
                class="py-2 px-4 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-200 flex items-center space-x-2"
            >
                <!-- Cambiar ícono según el estado de $menuOpen -->
                <i class="{{ $menuOpen ? 'fas fa-times' : 'fas fa-bars' }} h-5 w-5"></i>
                <span>Menú</span>
            </button>
            
            <div id="dropdownMenu" class="{{ $menuOpen ? 'mt-2 space-y-2' : 'hidden' }}">
                <!-- Botón de Eventos -->
                <button 
                    wire:click="setActiveComponent('services')" 
                    class="py-2 px-4 rounded-md text-white 
                        {{ $activeButton === 'services' ? 'bg-blue-800' : 'bg-blue-600 hover:bg-blue-700' }} 
                        transition duration-200 flex items-center space-x-2"
                >
                    <i class="fas fa-calendar h-5 w-5"></i>
                    <span>Eventos</span>
                </button>
            
                <!-- Botón de Premios -->
                <button 
                    wire:click="setActiveComponent('awards')" 
                    class="py-2 px-4 rounded-md text-white 
                        {{ $activeButton === 'awards' ? 'bg-blue-800' : 'bg-blue-600 hover:bg-blue-700' }} 
                        transition duration-200 flex items-center space-x-2"
                >
                    <i class="fas fa-trophy h-5 w-5"></i>
                    <span>Premios</span>
                </button>
            
                <!-- Botón de Certificados -->
                <button 
                    wire:click="setActiveComponent('certificates')" 
                    class="py-2 px-4 rounded-md text-white 
                        {{ $activeButton === 'certificates' ? 'bg-blue-800' : 'bg-blue-600 hover:bg-blue-700' }} 
                        transition duration-200 flex items-center space-x-2"
                >
                    <i class="fas fa-certificate h-5 w-5"></i>
                    <span>Certificados</span>
                </button>
    
                <!-- Divider -->
                <hr class="border-gray-400 my-2">
    
               
            </div>
        </div>
    </div>
    
    
    
    <!-- Contenido según el componente activo -->
    <div class="p-2 rounded-lg shadow-md">
        @if ($activeButton === 'awards')
            <livewire:provider-awards />
        @elseif ($activeButton === 'certificates')
        <livewire:upload-certificate />
        @elseif ($activeButton === 'services')
        <livewire:provider-services />
        @endif
    </div>

  
</div>

