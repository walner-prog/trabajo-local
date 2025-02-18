<div class="space-y-6">

    <!-- Filtros -->
    <div x-data="{ open: false }" class="w-full">
        <!-- Botón para abrir/cerrar el dropdown en pantallas pequeñas -->
        <button 
            @click="open = !open" 
            class="bg-blue-900 dark:bg-blue-800 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out flex items-center justify-between w-full sm:hidden">
            <span>Filtros</span>
            <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="ml-2"></i>
        </button>

        <!-- Contenedor de filtros -->
        <div 
            x-cloak 
            x-show="open || window.innerWidth >= 640" 
            x-transition
            class="flex flex-col gap-4 mt-4 sm:flex-row sm:gap-6 sm:items-center sm:justify-between sm:mt-0">
            <!-- Campo de búsqueda -->
            <div class="flex items-center bg-gradient-to-br from-gray-200 to-blue-200 text-slate-700 rounded-full shadow-lg p-2 w-full sm:w-auto">
                <i class="fas fa-search text-gray-500 mr-2"></i>
                <input 
                    type="text" 
                    wire:model.defer="tempSearch" 
                    placeholder="Buscar por nombre, especialidad o ciudad"
                    class="border-0 rounded-full px-4 py-2 dark:bg-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Select para especialidad -->
            <div class="relative">
                <select 
                    wire:model.defer="tempSpecialty" 
                    class="block w-full sm:w-64 px-4 py-2 rounded-md bg-gradient-to-br from-gray-200 to-blue-200 text-slate-700 dark:bg-gray-800 dark:text-gray-200 border focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Todas las especialidades</option>
                    @foreach (App\Models\Proveedor::select('specialty')->distinct()->pluck('specialty') as $specialty)
                        <option value="{{ $specialty }}">{{ $specialty }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select para ciudad -->
            <div class="relative">
                <select 
                    wire:model.defer="tempCity" 
                    class="block w-full sm:w-64 px-4 py-2 rounded-md bg-gradient-to-br from-gray-200 to-blue-200 text-slate-700 dark:bg-gray-800 dark:text-gray-200 border focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Todas las ciudades</option>
                    @foreach (App\Models\Proveedor::select('city')->distinct()->pluck('city') as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select para años de experiencia -->
            <div class="relative">
                <input 
                    wire:model.defer="tempExperienceYears" 
                    type="number" 
                    placeholder="Años de experiencia" 
                    class="block w-full sm:w-64 px-4 py-2 rounded-md bg-gradient-to-br from-gray-200 to-blue-200 text-slate-700 dark:bg-gray-800 dark:text-gray-200 border focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Botón para aplicar filtros -->
            <button 
                wire:click="applyFilters" 
                class="bg-blue-600 dark:bg-blue-800 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">
                <i class="fas fa-search mr-2"></i> 
                Aplicar filtros
            </button>
        </div>
    </div>

    <!-- Listado de proveedores -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($proveedores as $proveedor)
        <div class="bg-gradient-to-br from-gray-200 to-blue-200 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 ease-in-out p-4 dark:bg-indigo-900 text-gray-800 dark:text-gray-100">
            <div class="flex flex-col justify-between h-full">
                <!-- Información del proveedor -->
                <h2 class="text-2xl font-semibold text-indigo-900 dark:text-indigo-200">{{ $proveedor->user->name }}</h2>
                <p class="text-lg text-gray-700 dark:text-gray-300">
                    <i class="fas fa-cogs text-blue-500 mr-2"></i> {{ $proveedor->specialty }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    <i class="fas fa-map-marker-alt text-teal-500 mr-2"></i> {{ $proveedor->city }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    <i class="fas fa-briefcase text-yellow-500 mr-2"></i> {{ $proveedor->experience_years }} años de experiencia
                </p>

                <!-- Enlace para ver más -->
                <a 
                    href="{{ route('proveedor.detalle', ['proveedor' => $proveedor->id]) }}"
                    class="mt-4 border border-blue-900 text-blue-900 dark:border-blue-200 dark:text-white dark:hover:bg-blue-900 py-2 px-6 rounded-md hover:bg-blue-900 hover:text-white transition duration-300 ease-in-out text-center">
                    <i class="fas fa-info-circle mr-2"></i> Ver más
                </a>

            </div>
        </div>
        @empty
        <!-- Mensaje cuando no hay resultados -->
        <p class="col-span-3 text-center text-gray-600 dark:text-gray-300">
            No se encontraron proveedores con los criterios seleccionados.
        </p>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $proveedores->links() }}
    </div>

</div>
