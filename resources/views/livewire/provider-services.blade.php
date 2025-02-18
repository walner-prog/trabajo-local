<div class="">
    @if (auth()->check() && auth()->user()->hasRole('proveedor'))
    <div class="mt-6">
        <!-- Botón para alternar el formulario -->

    @if(session()->has('message') || session()->has('error'))
    <div id="flash-message" class="mt-4 max-w-lg mx-auto p-4 rounded-lg text-white flex items-center space-x-3 
        @if(session()->has('error')) bg-red-500 @else bg-indigo-800 @endif">
        <svg class="h-6 w-6"
             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            @if(session()->has('error'))
                <!-- Icono de error -->
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            @else
                <!-- Icono de éxito -->
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            @endif
        </svg>
        <span>{{ session('message') ?? session('error') }}</span>
    </div>
@endif

        <!-- Formulario para agregar o editar un premio -->
        @if ($showForm)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 z-50">
            <div class="bg-white dark:bg-indigo-700 shadow-lg rounded-md border border-gray-300 p-6 sm:p-8 w-full max-w-sm sm:max-w-md lg-max-w-lg overflow-auto max-h-[80vh] relative">
                
                <!-- Botón de cerrar -->
                <button wire:click="toggleForm" class="absolute top-2 right-2 text-white bg-red-500 rounded-full p-2 hover:bg-red-600">
                    <i class="fas fa-times"></i>
                </button>
    
                <form wire:submit.prevent="saveService" class="mb-4">
                    <!-- Campo: Título del Servicio -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título del Servicio</label>
                        <div class="relative">
                            <i class="fas fa-tag absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                            <input type="text" id="title" wire:model="title" 
                                class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" 
                                placeholder="Título del servicio" />
                        </div>
                        @error('title') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Campo: Descripción -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                        <div class="relative">
                            <i class="fas fa-align-left absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                            <textarea id="description" wire:model="description" 
                                class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" 
                                placeholder="Descripción del servicio"></textarea>
                        </div>
                        @error('description') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Campo: Precio -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio</label>
                        <div class="relative">
                            <i class="fas fa-dollar-sign absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                            <input type="number" id="price" wire:model="price" step="0.01" min="0" 
                                class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" 
                                placeholder="Precio del servicio" />
                        </div>
                        @error('price') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                    </div>
                    
        
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="availability" wire:model="availability" class="mr-2" {{ $availability ? 'checked' : '' }}>
                        <label for="availability" class="text-sm font-medium text-gray-700 dark:text-gray-300">Disponible</label>
                    </div>
                    
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="home_service" wire:model="home_service" class="mr-2" {{ $home_service ? 'checked' : '' }}>
                        <label for="home_service" class="text-sm font-medium text-gray-700 dark:text-gray-300">Servicio a Domicilio</label>
                    </div>
                    
                  
                
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoría</label>
                        <div class="relative">
                            <i class="fas fa-layer-group absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                            <select id="category_id" wire:model="category_id" 
                                class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800">
                                <option value="">Seleccione una categoría</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Botón de envío -->
                    <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-md flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        @if ($selectedService) Actualizar Servicio @else Guardar Servicio @endif
                    </button>
                </form>
                
            </div>
        </div>
        @endif

        <div class="mb-4">
        
         
        
            
            @if($showFormCategory)
            <div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 z-50">
             <div class="bg-white dark:bg-indigo-700 shadow-lg rounded-md border border-gray-300 p-6 sm:p-8 w-full max-w-sm sm:max-w-md lg-max-w-lg overflow-auto max-h-[80vh] relative">
                <div class="mb-4">
                    <label for="category_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título de la categoria</label>
                        <div class="relative">
                            <i class="fas fa-tag absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                            <input type="text" id="category_name" wire:model="category_name" 
                                class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" 
                                placeholder="Título de la Categoria" />
                        </div>
                    @error('category_name') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <div class="mt-4">
                    <label for="category_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                        <div class="relative">
                            <i class="fas fa-align-left absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                            <textarea id="category_description" wire:model="category_description" 
                                class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" 
                                placeholder="Descripción del servicio"></textarea>
                        </div>
                    @error('category_description') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <div class="mt-4 flex justify-end">
                    <button wire:click="saveCategory" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                        Guardar
                    </button>
                    <button wire:click="$toggle('showFormCategory')" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancelar
                    </button>
                </div>
             </div>
           </div>

            @endif
        </div>

        <div class="p-4">
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Tus Servicios  <span class="text-gray-500">({{ $services->count() }})</span></h2>

                    <button wire:click="$toggle('showFormCategory')" class="bg-blue-500 text-white px-4 px-3 py-1 rounded-md flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Agregar Categoría
                    </button>
                    <button 
                    wire:click="toggleForm" 
                    class="bg-blue-600 text-white px-3 py-1 rounded-md flex items-center space-x-2"
                >
                    @if ($showForm)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>Ocultar Formulario</span>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Agregar</span>
                    @endif
                </button>
                </div>

                <!-- Tabla responsiva -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-200 text-gray-700 text-sm">
                            <tr>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-600">Nombre del Servicio</th>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-600">Descripción</th>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-600">Precio</th>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-600">Categoría</th>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-600">A Domicilio</th>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-600">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                                <td class="border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $service->title }}</td>
                                <td class="border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $service->description }}</td>
                                <td class="border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $service->price }}</td>
                                <td class="border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $service->category->name }}</td>
                                <td class="border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                    {{ $service->home_service ? 'Sí' : 'No' }}
                                </td>
                                
                                <td class="border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                    <div class="flex space-x-4">
                                        <button wire:click="editService({{ $service->id }})" class="hover:text-blue-700 text-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <button wire:click="deleteService({{ $service->id }})" class="text-red-500 hover:text-red-700 ml-4 focus:outline-none focus:ring-2 focus:ring-red-300 rounded">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
    @else
        <p class="text-red-500">No tienes permiso para gestionar Servicios.</p>
    @endif
</div>
<script>
    function toggleDropdown(event) {
  const dropdown = event.target.closest('div').querySelector('.dropdown-menu');
  dropdown.classList.toggle('hidden');
 }
 </script>
