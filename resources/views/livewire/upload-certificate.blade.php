<div>

    <div id="myModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden z-50">
        <div class="flex justify-center items-center h-screen">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl mx-4 p-6">
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800">Reseña de Certificados Médicos Digitales</h2>
                    <button id="closeModalButton" class="text-gray-500 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="text-gray-700">
                    <p><strong>¡Organiza y Muestra tu Experiencia!</strong></p>
                    <p>En un mundo cada vez más digitalizado, tener acceso a nuestros certificados médicos de forma rápida y segura es esencial...</p>
                    <p>Los certificados médicos digitales permiten tener un registro seguro, accesible desde cualquier lugar, y facilitan la validación ante instituciones y empleadores.</p>
                    <p>Este sistema no solo asegura que tengas acceso a tus certificados en cualquier momento, sino que también ofrece la posibilidad de compartirlos fácilmente con las partes interesadas.</p>
                </div>
                
               
            </div>
        </div>
    </div>
    
    
    @if (auth()->check() && auth()->user()->hasRole('proveedor') )

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

    @if($showForm)

    <div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 z-50">
        <div class="bg-white dark:bg-indigo-700 shadow-lg rounded-md border border-gray-300 p-6 sm:p-8 w-full max-w-sm sm:max-w-md lg:max-w-lg overflow-auto max-h-[80vh] relative">
            
            <!-- Botón de cerrar -->
            <button wire:click="toggleForm" class="absolute top-2 right-2 text-white bg-red-500 rounded-full p-2 hover:bg-red-600">
                <i class="fas fa-times"></i>
            </button>

            <form wire:submit.prevent="uploadCertificate" class="space-y-4">
                <!-- Campo de Título -->
                <div>
                    <label for="title" class="block text-sm font-medium dark:text-gray-300">Título del certificado</label>
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-certificate"></i>
                        </span>
                        <input type="text" id="title" wire:model="title" 
                            class="mt-1 p-2 pl-10 w-full border rounded-md dark:text-slate-700 dark:bg-gray-100 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Ej: Certificado de Especialidad" />
                    </div>
                    @error('title') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <!-- Campo de Subida de Archivo -->
                <div>
                    <label for="certificate" class="block text-sm font-medium dark:text-gray-300">Subir Certificado (PDF)</label>
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-file-pdf"></i>
                        </span>
                        <input type="file" id="certificate" wire:model="certificate" 
                            class="mt-1 p-2 pl-10 w-full border rounded-md dark:text-gray-700 dark:bg-gray-100 focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                    @error('certificate') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <!-- Botón de Envío -->
                <div>
                    <button type="submit" 
                        class="w-full bg-blue-900 text-white px-4 py-2 rounded-md hover:bg-blue-950 transition duration-300 ease-in-out">
                        Subir Certificado
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif

<div class="p-4">
    <div class="bg-white dark:bg-slate-800 shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Certificados <span class="text-gray-500">({{ $certificates->count() }})</span></h2>
            <div class="flex items-center space-x-4">
                <!-- Botón principal siempre visible -->
                <button 
                    wire:click="toggleForm" 
                    class="bg-blue-800 text-white px-3 py-1 rounded-md flex items-center space-x-2 hover:bg-blue-900 transition duration-300 ease-in-out"
                >
                    @if ($showForm)
                        <i class="fas fa-times"></i>
                        <span>Cerrar Formulario</span>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Subir</span>
                    @endif
                </button>
        
              
            </div>
        </div>
    
        <!-- Tabla responsiva -->
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left dark:text-slate-900">Título del Certificado</th>
                        <th class="border px-4 py-2 text-left dark:text-slate-900">Fecha de Subida</th>
                        <th class="border px-4 py-2 text-left dark:text-slate-900">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($certificates as $certificate)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                            <td class="border px-4 py-2">{{ $certificate->title }}</td>
                            <td class="border px-4 py-2">{{ $certificate->created_at->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2 text-sm">
                                <div class="flex space-x-4">
                                <button wire:click="editCertificate({{ $certificate->id }})" class="text-blue-500 hover:text-blue-700 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 rounded">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <button wire:click="confirmDelete({{ $certificate->id }})" class="text-red-500 hover:text-red-700 ml-4 text-sm">
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

<script>
    function toggleDropdown(event) {
        const dropdown = event.target.closest('div').querySelector('.dropdown-menu');
        dropdown.classList.toggle('hidden');
    }
</script>


@if($confirmingDelete)
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-sm mx-4 p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">¿Estás seguro?</h2>
            <p class="text-gray-700 mb-4">¿Deseas eliminar este certificado? Esta acción no se puede deshacer.</p>
            <div class="flex justify-between">
                <button wire:click="deleteCertificate" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Sí, Eliminar</button>
                <button wire:click="$set('confirmingDelete', false)" class="bg-gray-300 text-black px-4 py-2 rounded-md hover:bg-gray-400">Cancelar</button>
            </div>
        </div>
    </div>
@endif
</div>
@else
    <p class="text-red-500"></p>
@endif

</div>

<script>
    // Obtener elementos
    const openModalButton = document.getElementById('openModalButton');
    const closeModalButton = document.getElementById('closeModalButton');
    const modal = document.getElementById('myModal');

    // Abrir el modal al hacer clic en el botón
    openModalButton.addEventListener('click', function() {
        modal.classList.remove('hidden'); // Mostrar el modal
    });

    // Cerrar el modal al hacer clic en el botón de cierre
    closeModalButton.addEventListener('click', function() {
        modal.classList.add('hidden'); // Ocultar el modal
    });

    // Cerrar el modal si se hace clic fuera de la caja del modal
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.classList.add('hidden'); // Ocultar el modal
        }
    });
</script>



