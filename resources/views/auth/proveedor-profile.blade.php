<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        @livewireStyles
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    </head>
    <body>
        
    <div class=" py-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-4 p-5 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
            <div class="flex flex-wrap -mx-3 " >
               
                    <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5 max-w-7xl mx-auto sm:px-6 lg:px-8  dark:bg-gray-800 text-gray-800 dark:text-gray-100">
                        <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30 ">
                            
        
                            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-8  dark:bg-gray-900 text-gray-800 dark:text-gray-100"">
                                <h2 class="text-2xl font-bold text-gray-800 mb-6">Complete su Perfil como Proveedor</h2>
                                <p class="text-sm text-gray-600 mb-8">
                                    Proporcione información precisa y detallada sobre su perfil profesional. Esto ayudará a los pacientes a encontrarlo y conectarse con usted de manera efectiva.
                                </p>
                                <form action="{{ url("/proveedor/profile/{$user->id}") }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                    @csrf
                            
                                    <!-- Especialidad -->
                                    <div class="flex flex-col">
                                        <label for="specialty" class="text-sm font-medium text-gray-700 mb-1">Especialidad</label>
                                        <input 
                                            type="text" 
                                            id="specialty" 
                                            name="specialty" 
                                            required 
                                            placeholder="Ejemplo: Cardiólogo, Pediatra" 
                                            class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        >
                                    </div>
                            
                                    <!-- Ciudad -->
                                    <div class="flex flex-col">
                                        <label for="city" class="text-sm font-medium text-gray-700 mb-1">Ciudad</label>
                                        <input 
                                            type="text" 
                                            id="city" 
                                            name="city" 
                                            required 
                                            placeholder="Ejemplo: Managua, León" 
                                            class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        >
                                    </div>
                            
                                    <!-- Años de experiencia -->
                                    <div class="flex flex-col">
                                        <label for="experience_years" class="text-sm font-medium text-gray-700 mb-1">Años de Experiencia</label>
                                        <input 
                                            type="number" 
                                            id="experience_years" 
                                            name="experience_years" 
                                            required 
                                            min="0" 
                                            placeholder="Ejemplo: 5" 
                                            class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        >
                                    </div>
                            
                                    <!-- Biografía -->
                                    <div class="flex flex-col">
                                        <label for="bio" class="text-sm font-medium text-gray-700 mb-1">Biografía</label>
                                        <textarea 
                                            id="bio" 
                                            name="bio" 
                                            placeholder="Describa brevemente su experiencia profesional y especialidad" 
                                            class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        ></textarea>
                                    </div>
                            
                                    <!-- Teléfono -->
                                    <div class="flex flex-col">
                                        <label for="phone" class="text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                                        <input 
                                            type="text" 
                                            id="phone" 
                                            name="phone" 
                                            placeholder="Ejemplo: +505 1234 5678" 
                                            class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        >
                                    </div>
                            
                                    <!-- Disponibilidad -->
                                   
                                    <div class="flex flex-col">
                                        <label class="text-sm font-medium text-gray-700 mb-1">Disponibilidad</label>
                                        <div class="flex flex-wrap gap-4">
                                            <label class="flex items-center gap-2">
                                                <input type="checkbox" name="availability[]" value="monday" class="accent-blue-500">
                                                Lunes
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="checkbox" name="availability[]" value="tuesday" class="accent-blue-500">
                                                Martes
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="checkbox" name="availability[]" value="wednesday" class="accent-blue-500">
                                                Miércoles
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="checkbox" name="availability[]" value="thursday" class="accent-blue-500">
                                                Jueves
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="checkbox" name="availability[]" value="friday" class="accent-blue-500">
                                                Viernes
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="checkbox" name="availability[]" value="saturday" class="accent-blue-500">
                                                Sábado
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="checkbox" name="availability[]" value="sunday" class="accent-blue-500">
                                                Domingo
                                            </label>
                                        </div>
                                    </div> 
                            
                                    <!-- Foto -->
                                   {{--  <div class="flex flex-col">
                                        <label for="photo" class="text-sm font-medium text-gray-700 mb-1">Foto de Perfil</label>
                                        <input 
                                            type="file" 
                                            id="photo" 
                                            name="photo" 
                                            class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        >
                                    </div> --}}


                               
                            
                                    <!-- Botón de envío -->
                                    <div class="flex justify-end">
                                        <button 
                                            type="submit" 
                                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        >
                                            Guardar Perfil
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
               
            </div>
        </div>


       
    </div>


    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
<script>
    // Inicializar AOS después de cargar la página
    AOS.init({
        duration: 500, // Duración de la animación en milisegundos
        once: true, // Ejecutar la animación solo una vez
    });
</script>




    </body>
    </html>
  
   



</x-app-layout>