<footer class="bg-gradient-to-br from-gray-900 to-blue-900 text-slate-300 dark:bg-gray-800 dark:text-gray-300 py-8">
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-4">
        <!-- Columna 1: Información de la empresa -->
        @if(session('success'))
        <div class="alert alert-success text-center aler">
            {{ session('success') }}
        </div>
        @endif
    
        @if(session('error'))
        <div class="alert alert-danger text-center bg-red-400">
            {{ session('error') }}
        </div>
       @endif
        <div>
            <h2 class="font-bold text-lg mb-4">TrabajoLocal</h2>
            <p>Conectamos a profesionales y clientes para facilitar servicios locales de calidad.</p>
        </div>
        
        <!-- Columna 2: Enlaces rápidos -->
        <div>
            <h2 class="font-bold text-lg mb-4">Enlaces rápidos</h2>
            <ul>
                <li><a href="{{ route('dashboard') }}" class="hover:underline dark:text-gray-300 dark:hover:text-white">Inicio</a></li>
              
                <li><a href="{{ route('quienes.somos') }}" class="hover:underline dark:text-gray-300 dark:hover:text-white">Quiénes Somos</a></li>
                <li><a href="{{ route('contacto') }}" class="hover:underline dark:text-gray-300 dark:hover:text-white">Contacto</a></li>
                <li><a href="{{ route('terms') }}" class="hover:underline dark:text-gray-300 dark:hover:text-white">Términos y Condiciones</a></li>
                <li><a href="{{ route('policies') }}" class="hover:underline dark:text-gray-300 dark:hover:text-white">Política de Privacidad</a></li>
            </ul>
        </div>

        <!-- Columna 3: Contacto -->
        <div>
            <h2 class="font-bold text-lg mb-4">Contacto</h2>
            <p>Correo: <a href="mailto:soporte@trabajolocal.com" class="hover:underline dark:text-gray-300 dark:hover:text-white">soporte@trabajolocal.com</a></p>
            <p>Teléfono: (505) 1234-5678</p>
        </div>

        <!-- Columna 4: Redes sociales y suscripción -->
        <div>
            <h2 class="font-bold text-lg mb-4">Síguenos</h2>
            <ul class="flex space-x-4 mb-4">
                <li><a href="https://facebook.com/trabajolocal" target="_blank" class="text-blue-500 hover:text-blue-400 dark:text-blue-400 dark:hover:text-blue-500">Facebook</a></li>
                <li><a href="https://twitter.com/trabajolocal" target="_blank" class="text-blue-500 hover:text-blue-400 dark:text-blue-400 dark:hover:text-blue-500">Twitter</a></li>
                <li><a href="https://instagram.com/trabajolocal" target="_blank" class="text-pink-500 hover:text-pink-400 dark:text-pink-400 dark:hover:text-pink-500">Instagram</a></li>
                <li><a href="https://linkedin.com/company/trabajolocal" target="_blank" class="text-blue-600 hover:text-blue-500 dark:text-blue-500 dark:hover:text-blue-600">LinkedIn</a></li>
            </ul>

            <h2 class="font-bold text-lg mb-4">Suscríbete</h2>
            <form wire:submit.prevent="subscribe">
                <input type="email" wire:model="email" placeholder="Tu correo electrónico" class="w-full p-2 rounded-lg border border-gray-300 text-slate-700 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Suscribirse</button>
            </form>
        </div>
    </div>

    <div class="text-center text-sm text-gray-400 dark:text-gray-500 mt-8">
        <p>&copy; {{ date('Y') }} TrabajoLocal. Todos los derechos reservados.</p>
      
    </div>
</footer>