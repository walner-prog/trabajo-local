<x-app-layout>
    <div class="py-24 mx-auto sm:px-6 lg:px-8 dark:bg-gray-900 dark:text-gray-100 overflow-hidden">
       
       {{--  <livewire:component-menu /> --}}
       @if(auth()->check() && auth()->user()->role === 'proveedor')
    
         <livewire:admin-sidebar />
      @else
   
      <div  class=" p-3 mt-24">
        <div class="bg-red-100 p-4 rounded-md border border-red-400 text-red-800 ">
            <strong>Acceso denegado:</strong> Para acceder a esta página, necesitas ser un <strong>proveedor</strong>.
            Si tienes alguna duda, por favor contacta con el administrador.
            </div>
    
        
            <div class="bg-gray-100 p-6 mt-4 rounded-md text-gray-800 ">
            <p>
                El acceso a esta página está restringido únicamente para aquellos usuarios con el rol de proveedor. 
                Este rol te permite gestionar los servicios, premios y certificados relacionados con tus productos o servicios. 
                Si crees que deberías tener este acceso, por favor asegúrate de que tu cuenta esté configurada correctamente o ponte en contacto con el administrador para obtener asistencia.
            </p>
        </div>
      </div>
       
@endif

   
      
    </div>
 
</x-app-layout>