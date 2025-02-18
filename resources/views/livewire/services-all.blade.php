<div>
    
    <div class="p-4 mb-2">
        <div class="mb-6">
            <input type="text" wire:model.debounce.500ms="search" placeholder="Buscar servicios..."
                class="w-full p-3 border rounded-md dark:bg-gray-700 dark:text-white">
        </div>
    
        
        <div class="mb-6 flex flex-wrap items-center space-x-4">
            
            <div class="relative">
                <button class="w-full sm:w-auto px-4 py-2 text-white bg-indigo-500 rounded-md focus:outline-none sm:hidden">
                    Filtros de Categoría
                </button>
                <div class="dropdown-content absolute left-0 mt-2 w-full bg-white shadow-lg rounded-md sm:hidden z-10 max-h-60 overflow-y-auto">
                    <div class="py-2">
                        @foreach($categories as $category)
                            <div class="flex items-center space-x-2 py-1 px-4">
                                <input type="checkbox" wire:model="categoryFilter" value="{{ $category->id }}"
                                    id="category-{{ $category->id }}" class="mr-2">
                                <label for="category-{{ $category->id }}" class="text-gray-700 dark:text-gray-300">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


           <div class="hidden sm:flex flex-wrap items-center space-x-2 py-1">
                <h3 class="font-semibold text-xl mb-2 ">Filtrar por Categoría</h3>
                  
                @foreach($categories as $category)
                    <div class="flex items-center space-x-2 py-1">
                        <input type="checkbox" wire:model="categoryFilter" value="{{ $category->id }}"
                            id="category-{{ $category->id }}" class="mr-2">
                        <label for="category-{{ $category->id }}" class="text-gray-700 dark:text-gray-300">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>
    
            <!-- Filtro de disponibilidad -->
            <div class="flex flex-wrap items-center space-x-2 mt-2">
                <h3 class="font-semibold text-xl mb-2">Filtrar por Disponibilidad</h3>
                <input type="checkbox" wire:model="availabilityFilter" value="1" id="available" class="mr-2">
                <label for="available" class="text-gray-700 dark:text-gray-300">Disponible</label>
    
                <h3 class="font-semibold text-xl mb-2">Filtrar por Servicio a Domicilio</h3>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="homeServiceFilter" value="1" id="home-service" class="mr-2">
                    <label for="home-service" class="text-gray-700 dark:text-gray-300">Servicio a Domicilio</label>
                </div>
                
                <div class="mb-6 ml-8">
                    <button wire:click="applyFilters" class="px-6 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">
                        Aplicar Filtros
                    </button>
                </div>
                
                <div class="mb-6">
                    <button wire:click="resetFilters" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        Resetear Filtros
                    </button>
                </div>
            </div>
        </div>
    </div>
   

    
  

    <!-- Servicios -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-2">
        
        @forelse($services as $service)
            <div class="bg-white p-4 mb-2 rounded-lg shadow-md dark:bg-gray-800">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-cogs text-indigo-500"></i>
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $service->title }}</h4>
                </div>
                <p class="text-sm text-gray-500 mt-2 dark:text-gray-300">{{ $service->description }}</p>
                <p class="text-sm text-gray-500 mt-2 dark:text-gray-300">Precio: ${{ $service->price }}</p>
                <p class="text-sm text-gray-500 mt-2 dark:text-gray-300">Disponibilidad: {{ $service->availability ? 'Disponible' : 'No disponible' }}</p>
                @if($service->home_service)
                    <p class="text-sm text-gray-500 mt-2 dark:text-gray-300">Servicio a domicilio: Sí</p>
                @endif
            </div>
        @empty
            <div class="col-span-3 text-center p-4 bg-gray-200 rounded-md dark:bg-gray-700">
                <p class="text-lg text-gray-700 dark:text-gray-300">No se encontraron servicios disponibles.</p>
            </div>
        @endforelse
    </div>
    
    
    <!-- Paginación -->
    <div class="mt-6">
        {{ $services->links() }}
    </div>

    <style>
        .dropdown-content {
            display: none;
        }
    
        .relative:hover .dropdown-content {
            display: block;
        }
    </style>
    
</div>
