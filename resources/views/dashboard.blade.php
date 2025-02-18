<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div  class="min-h-screen bg-gradient-to-br from-gray-800 to-blue-800 text-white flex flex-col max-w-12xl mx-auto sm:px-6 lg:px-8 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
                 
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

 
       @if (!Auth::check())  <!-- Verificamos si el usuario NO está autenticado -->
       <div class="alert alert-info flex items-center justify-between p-4 mb-4 bg-blue-100 text-blue-800 rounded-lg">
           <span class="mr-2">¡Inicia sesión para disfrutar de todos los beneficios de Trabajo Local!</span>
           <button class="text-blue-800" onclick="this.parentElement.style.display='none'">
               <i class="fas fa-times"></i>
           </button>
       </div>
   @endif
            
            
        <!-- Hero Section -->
        <section 
        class="flex flex-col md:flex-row items-center justify-between px-4 md:px-8 py-8 md:py-16 space-y-8 md:space-y-0">
   
   <!-- Contenido principal -->
   <div class="max-w-lg text-center md:text-left">
       <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4">
           ¿Eres un Profesional o Técnico? 
       </h1>
       <p class="text-base md:text-lg text-gray-300 mb-6">
           ¡Únete a <span class="text-orange-400 font-semibold">Trabajo Local</span> y conecta con más clientes en tu área! 🌟
       </p>
       <ul class="text-gray-300 text-lg space-y-2 mb-6">
           <li>✅ Promociona tus servicios.</li>
           <li>✅ Llega a más personas.</li>
           <li>✅ Aumenta tus ingresos.</li>
       </ul>
       <p class="text-gray-300 text-lg mb-6">
        Ya seas abogado, chef, profesor, agrónomo, ingeniero, electricista, diseñador gráfico, mecánico, carpintero, plomero, fotógrafo, desarrollador web o cualquier otro profesional, <span class="text-orange-400 font-semibold">Trabajo Local</span> es tu plataforma para crecer. 🚀
       </p>
    
       <a href="{{ route('register') }}" 
          class="inline-block bg-orange-400 text-gray-900 px-4 py-2 md:px-6 md:py-3 rounded-lg text-base md:text-lg shadow-lg transition duration-300 ease-in-out transform hover:bg-orange-500 hover:scale-105 hover:shadow-xl">
          ¡Regístrate Gratis!
       </a>
   </div>

   <!-- Imagen y Datos -->
   <div class="relative w-full md:w-1/2 p-6 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl shadow-lg">
    <!-- Título llamativo -->
    <h2 class="text-3xl font-bold text-white mb-4">
        ¡Consigue Más Clientes y Expande tu Negocio! 🚀
    </h2>
    
    <!-- Descripción -->
    <p class="text-lg text-gray-100 mb-6">
        Profesionales y técnicos como tú ya están encontrando oportunidades. Publica tus servicios y conecta con clientes en tu área de manera rápida y sencilla.
    </p>
    
    <!-- Beneficios -->
    <ul class="text-gray-200 text-lg mb-6 space-y-2">
        <li>✅ Aumenta tu visibilidad en tu ciudad.</li>
        <li>✅ Recibe solicitudes de clientes interesados.</li>
        <li>✅ Expande tu negocio con facilidad.</li>
    </ul>

    <!-- Botón atractivo para acción -->
    <a href="{{ route('register') }}" 
       class="relative inline-block bg-white text-orange-600 px-6 py-3 rounded-lg text-lg font-semibold shadow-lg transition duration-500 ease-in-out transform hover:bg-gray-100 hover:scale-105 hover:shadow-xl">
       ¡Regístrate Gratis!
    </a>

   
</div>

</section>

    
        <!-- Cards y Texto Adicional -->
        <section 
        class="flex flex-col lg:flex-row items-center lg:justify-between px-4 md:px-8 py-8 md:py-16 space-y-8 lg:space-y-0">

   <!-- Tarjetas -->
   <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full">


     <div class="bg-gradient-to-br  from-yellow-400 to-orange-300 rounded-xl p-6 shadow-lg flex flex-col items-center">
        <div class="text-gray-800 text-sm font-semibold text-slate-50">Encuentra Servicios</div>
        <div class="mt-4 text-gray-800 text-4xl font-extrabold text-slate-50">Fácil y Rápido</div>
        <div class="mt-2 text-gray-800 text-sm font-semibold text-slate-50">+100 Localidades</div>
        <div class="mt-4 text-gray-800 text-sm text-slate-50">Filtra por ubicación, categoría y disponibilidad.</div>
        <!-- Icono -->
        <div class="mt-6 text-gray-800 text-slate-50 text-6xl animate-pulse transition-transform transform hover:translate-y-2">
            <i class="fas fa-search-location"></i>
        </div>
    </div>


       <!-- Tarjeta 1 - Diversidad de Profesionales -->
       <div class="bg-gradient-to-br from-orange-500 to-red-400 rounded-xl p-6 shadow-lg flex flex-col items-center">
           <div class="text-white text-sm font-semibold">Profesionales y Técnicos</div>
           <div class="mt-4 text-white text-lg font-bold">+30 Especialidades</div>
           <div class="mt-2 text-white text-4xl font-extrabold">Calificados</div>
           <div class="mt-4 text-white text-sm">Encuentra expertos en diversas áreas:  abogados, chefs, profesores, agrónomos, ingenieros, electricistas,  y más.</div>
           <!-- Icono -->
           <div class="mt-6 text-white text-6xl animate-pulse transition-transform transform hover:translate-y-2">
               <i class="fas fa-users"></i>
           </div>
       </div>

      
       <!-- Tarjeta 3 - Consejos y Recomendaciones -->
     

       <!-- Tarjeta 4 - Seguridad y Confianza -->
       <div class="bg-gradient-to-br from-teal-500 to-green-400 rounded-xl p-6 shadow-lg flex flex-col items-center">
           <div class="text-white text-sm font-semibold">Tu Seguridad es Primero</div>
           <div class="mt-4 text-white text-lg font-bold">Conexiones Confiables</div>
           <div class="mt-2 text-white text-4xl font-extrabold">Verificados</div>
           <div class="mt-4 text-white text-sm">Garantizamos un entorno seguro con profesionales recomendados.</div>
           <!-- Icono -->
           <div class="mt-6 text-white text-6xl animate-pulse transition-transform transform hover:translate-y-2">
               <i class="fas fa-shield-alt"></i>
           </div>
       </div>

   </div>

   <!-- Texto Lateral -->
   <div class="w-full lg:w-1/3 text-center lg:text-left p-4">
       <div class="mb-10">
           <h2 class="text-4xl font-bold">Encuentra a los <span class="text-orange-400">Mejores Profesionales</span></h2>
           <p class="text-lg">Accede a una red confiable y calificada.</p>
           <ul class="mt-4 text-sm">
               <li>✅ Perfiles Verificados</li>
               <li>✅ Diversas Especialidades</li>
               <li>✅ Reseñas de Clientes</li>
           </ul>
       </div>
       <div>
           <h2 class="text-4xl font-bold">Consigue Más <span class="text-yellow-400">Clientes</span></h2>
           <p class="text-lg">Haz crecer tu negocio con más oportunidades.</p>
           <ul class="mt-4 text-sm">
               <li>📌 Publica tu servicio en minutos</li>
               <li>📌 Conecta con clientes de tu ciudad</li>
               <li>📌 Soporte y asistencia</li>
           </ul>
       </div>
   </div>

   </section>

   <livewire:proveedor-profile />
   
   
 

 </div>


</div>

</x-app-layout>
