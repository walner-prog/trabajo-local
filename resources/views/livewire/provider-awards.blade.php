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
    
                <form wire:submit.prevent="saveAward" class="mb-4">
                    <!-- Campo: Nombre del Premio -->
                    <div class="mb-4">
                        <label for="award_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del Premio</label>
                        <div class="relative">
                            <i class="fas fa-award absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                            <input type="text" id="award_name" wire:model="award_name" 
                                class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" 
                                placeholder="Nombre del premio" />
                        </div>
                        @error('award_name') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Campo: Institución -->
                    <div class="mb-4">
                        <label for="awarding_institution" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Institución que otorga el premio</label>
                        <div class="relative">
                            <i class="fas fa-university absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                            <input type="text" id="awarding_institution" wire:model="awarding_institution" 
                                class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" 
                                placeholder="Institución que otorga el premio" />
                        </div>
                        @error('awarding_institution') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción (opcional)</label>
                        <div class="relative">
                            <i class="fas fa-align-left absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                            <textarea id="description" wire:model="description" 
                                class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" 
                                placeholder="Descripción del premio"></textarea>
                        </div>
                        @error('description') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Campo: Año -->
                    <div class="mb-4">
                        <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Año</label>
                        <div class="relative">
                            <i class="fas fa-calendar-alt absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                            <input type="number" id="year" wire:model="year" 
                                class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" 
                                placeholder="Año de otorgamiento" />
                        </div>
                        @error('year') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Botón de envío -->
                    <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-md flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        @if ($selectedAward) Actualizar Premio @else Guardar Premio @endif
                    </button>
                </form>
            </div>
        </div>
        @endif

        <div class="p-4">
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Premios <span class="text-gray-500">({{ $awards->count() }})</span></h2>
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
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-600">Nombre del Premio</th>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-600">Institución</th>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-600">Año</th>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-600">Descripción</th>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-600">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($awards as $providerAward)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                            <td class="border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $providerAward->award_name }}</td>
                            <td class="border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $providerAward->awarding_institution }}</td>
                            <td class="border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $providerAward->year }}</td>
                            <td class="border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $providerAward->description }}</td>
                            <td class="border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                   <div class="flex space-x-4">
                                        <button wire:click="editAward({{ $providerAward->id }})"  class=" hover:text-blue-700 text-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <button wire:click="deleteAward({{ $providerAward->id }})" class="text-red-500 hover:text-red-700 ml-4 focus:outline-none focus:ring-2 focus:ring-red-300 rounded">
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
        <p class="text-red-500">No tienes permiso para gestionar premios.</p>
    @endif
</div>
<script>
    function toggleDropdown(event) {
  const dropdown = event.target.closest('div').querySelector('.dropdown-menu');
  dropdown.classList.toggle('hidden');
 }
 </script>
