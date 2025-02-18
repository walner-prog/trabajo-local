<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use App\Models\Proveedor;
new class extends Component
{
    /**
     * Log the current user out of the application.
     */
     public $proveedor; 

     public function mount()
    {
        // Obtener el proveedor relacionado con el usuario autenticado
        $this->proveedor = Proveedor::where('user_id', Auth::id())->first();
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-gradient-to-br from-gray-200 to-blue-200 dark:bg-gray-800 dark:text-gray-300 text-gray-200 dark:bg-gray-900 fixed w-full z-20 top-0 start-0  dark:border-gray-600">
    <!-- Primary Navigation Menu -->
    <div class=" max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto ">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-1 rtl:space-x-reverse">
            <img src="{{ asset('images/logo.png') }}" class="h-25 w-20" alt="logo">

      {{--             <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Social Medical</span> --}}
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse ">
    
            <div x-data="{ open: false }" class="md:hidden">
                <!-- Menu Toggle Button -->
            
              <button @click="open = !open" 
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open main menu</span>
            <svg x-show="!open" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
            <svg x-show="open" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
             </button>

                
            
                <!-- Responsive Menu -->
                <div 
                x-show="open"
                x-transition:enter="transform transition-transform ease-in-out duration-300"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition-transform ease-in-out duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="fixed top-20 right-0 w-3/4 h-full bg-white shadow-md z-50 dark:bg-gray-800 md:hidden"
                x-cloak
            >

                     @auth
                     
                     <div class="flex items-center space-x-3 rtl:space-x-reverse p-3 bg-gray-100 dark:bg-gray-700 rounded-lg">
                        <!-- Imagen del Usuario -->
                      <div class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center bg-gray-200">
                        @if(auth()->user()->avatar)
                            <img 
                                src="{{ filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : asset('storage/' . auth()->user()->avatar) }}" 
                                alt="Avatar" 
                                class="w-full h-full object-cover"
                            >
                        @else
                            <!-- Ícono por defecto si no hay avatar -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c3.313 0 6-2.687 6-6s-2.687-6-6-6-6 2.687-6 6 2.687 6 6 6zM12 16c-4.418 0-8 2.686-8 6v2h16v-2c0-3.314-3.582-6-8-6z" />
                            </svg>
                        @endif
                      </div>
                       <!-- Nombre y Rol del Usuario -->
                      <div>
                        <p class="text-gray-800 dark:text-white font-semibold text-sm">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-gray-500 dark:text-gray-300 text-xs">
                            {{ __(auth()->user()->role ?? 'Usuario') }}
                        </p>
                      </div>
                     </div>
                    @endauth
    
                <!-- Inicio -->
<a href="{{ route('dashboard') }}" 
class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
 {{ __('Inicio') }}
</a>

<!-- Servicios -->
<a href="{{ route('servicios') }}" 
class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
 {{ __('Servicios') }}
</a>

<!-- Profesionales -->
<a href="{{ route('profesionales') }}" 
class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
 {{ __('Profesionales') }}
</a>

<!-- Quiénes Somos -->
<a href="{{ route('quienes.somos') }}" 
class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
 {{ __('Quiénes Somos') }}
</a>

<!-- Contacto -->
<a href="{{ route('contacto') }}" 
class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
 {{ __('Contacto') }}
</a>


                   @auth
                   @if(auth()->user()->role === 'proveedor')
                    <div x-data="{ open: false }" class="relative">
                   <!-- Botón para mostrar el Dropdown -->
                    <button @click="open = !open" class="block w-full text-left text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2  mb-4">
                    {{ __('Opciones para Proveedores') }}
                    <svg class="w-4 h-4 inline ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                    </button>

                <!-- Contenido del Dropdown -->
                <div x-show="open" @click.away="open = false" x-cloak class="absolute left-0 mt-2 w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md z-50 p-6">
                    <a href="{{ route('proveedor.detalle', auth()->user()->id) }}" class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2  mb-4">
                        {{ __('Revisa tu perfil') }}
                    </a>
                  {{--   <a href="{{ route('blogs.accions') }}" class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2  mb-4">
                        {{ __('Gestiona tus publicaciones') }}
                    </a> --}}
                    
                </div>
            </div>
               @endif
           @endauth


                  
        
                    
                    @auth

                    
                    <!-- Opciones para usuarios autenticados -->
                    <a href="{{ route('profile') }}"  class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2  mb-4">
                        {{ __('Perfil') }}
                    </a>
                    @if (Auth::check() && Auth::user()->role === 'proveedor')
                    <div class="mb-4 p-4 bg-gray-100 rounded-md">
                       
                
                        <a href="{{ route('proveedor.upload-certificate', $proveedor->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition duration-300 ease-in-out">
                            Subir Certificado
                        </a>
                    </div>
                   @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"  class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2  mb-4">
                            {{ __('Cerrar') }}
                        </button>
                    </form>
                    
                    
                @else
                    <!-- Opciones para usuarios no autenticados -->
                    <a href="{{ route('login') }}"  class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2  mb-4" >
                        {{ __('Iniciar') }}
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"  class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2  mb-4">
                            {{ __('Registrarse') }}
                        </a>
                    @endif
                @endauth

               
                </div>
            </div>
            
        </div>
        
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <div class="flex ">
            
                <div class="hidden sm:flex space-x-4 sm:-my-px sm:ms-auto  ">
                   <!-- Inicio -->
<a href="{{ route('dashboard') }}" 
class="text-gray-700 dark:text-gray-300 py-2 rounded-lg relative 
       after:content-[''] after:absolute after:bottom-0 after:left-0 
       after:w-0 after:h-0.5 after:bg-indigo-500 
       hover:after:w-full hover:after:transition-all hover:after:duration-300 
       {{ request()->routeIs('dashboard') ? 'after:w-full' : '' }}">
 {{ __('Inicio') }}
</a>

<!-- Servicios -->
<a href="{{ route('servicios') }}" 
class="text-gray-700 dark:text-gray-300 py-2 rounded-lg relative 
       after:content-[''] after:absolute after:bottom-0 after:left-0 
       after:w-0 after:h-0.5 after:bg-indigo-500 
       hover:after:w-full hover:after:transition-all hover:after:duration-300 
       {{ request()->routeIs('servicios') ? 'after:w-full' : '' }}">
 {{ __('Servicios') }}
</a>

<!-- Profesionales -->
<a href="{{ route('profesionales') }}" 
class="text-gray-700 dark:text-gray-300 py-2 rounded-lg relative 
       after:content-[''] after:absolute after:bottom-0 after:left-0 
       after:w-0 after:h-0.5 after:bg-indigo-500 
       hover:after:w-full hover:after:transition-all hover:after:duration-300 
       {{ request()->routeIs('profesionales') ? 'after:w-full' : '' }}">
 {{ __('Profesionales') }}
</a>



<!-- Contacto -->
<a href="{{ route('contacto') }}" 
class="text-gray-700 dark:text-gray-300 py-2 rounded-lg relative 
       after:content-[''] after:absolute after:bottom-0 after:left-0 
       after:w-0 after:h-0.5 after:bg-indigo-500 
       hover:after:w-full hover:after:transition-all hover:after:duration-300 
       {{ request()->routeIs('contacto') ? 'after:w-full' : '' }}">
 {{ __('Contacto') }}
</a>

                   
                
          
                   
                
                    <a href="{{ route('quienes.somos') }}" 
                       class="block text-gray-700 dark:text-gray-300  py-2 rounded-lg relative 
                             
                              after:content-[''] after:absolute after:bottom-0 after:left-0 
                              after:w-0 after:h-0.5 after:bg-indigo-500 
                              hover:after:w-full hover:after:transition-all hover:after:duration-300 
                              {{ request()->routeIs('quienes.somos') ? 'after:w-full' : '' }}">
                        {{ __('Quienes Somos') }}
                    </a>

                    @auth
                    @if(auth()->user()->role === 'proveedor')
                     <div x-data="{ open: false }" class="relative">
                    <!-- Botón para mostrar el Dropdown -->
                     <button @click="open = !open" class=" text-gray-700  dark:text-gray-300  rounded-lg  py-2
                      after:content-[''] after:absolute after:bottom-0 after:left-0 
                              after:w-0 after:h-0.5 after:bg-indigo-500 
                              hover:after:w-full hover:after:transition-all hover:after:duration-300 ">
                     {{ __('Opciones para Proveedores') }}
                     
                     </button>
 
                 <!-- Contenido del Dropdown -->
                 <div x-show="open" @click.away="open = false" x-cloak class="absolute left-0 mt-2 w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md z-50">
                     <a href="{{ route('proveedor.detalle', auth()->user()->id) }}" class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2">
                         {{ __('Revisa tu perfil') }}
                     </a>
                     {{-- <a href="{{ route('blogs.accions') }}" class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2">
                         {{ __('Gestiona tus publicaciones') }}
                     </a> --}}
                     
                 </div>
             </div>
                @endif
            @endauth
                    
          

         

           
                    
                </div>
                
                
             
             
                  </div>

                  <div  class=" text-gray-700 dark:text-gray-300  py-2 rounded-lg relative ml-24 "> 
                   {{--  @livewire('post-counter') --}}
  
              </div>
  
              <div  class="block text-gray-700 dark:text-gray-300  py-2 rounded-lg relative  ml-4"> 
                {{--   <livewire:info-tooltip /> --}}
  
             </div>

            
           

         
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

           <!-- Settings Dropdown -->
           <div class="relative hidden sm:flex sm:items-center sm:ms-6 mr-34 ">
            @auth
                <!-- Dropdown para usuarios autenticados -->
                <div x-data="{ open: false, name: '' }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-500 bg-gradient-to-br from-gray-100 to-blue-100 border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:ring focus:ring-blue-500 transition">
                        <div class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center bg-gray-200">
                            @if(auth()->user()->avatar)
                                <img src="{{ filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c3.313 0 6-2.687 6-6s-2.687-6-6-6-6 2.687-6 6 2.687 6 6 6zM12 16c-4.418 0-8 2.686-8 6v2h16v-2c0-3.314-3.582-6-8-6z" />
                                </svg>
                            @endif
                        </div>
                        <span x-text="name"></span>
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-gradient-to-br from-gray-200 to-blue-200 border border-gray-200 rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700" x-cloak>
                        <a href="{{ route('profile') }}" class="w-full text-start block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                            {{ __('Perfil') }}  
                        </a>

                        @if (Auth::check() && Auth::user()->role === 'proveedor')
                       
                           
                    
                            <a href="{{ route('proveedor.upload-certificate', $proveedor->id) }}" class="w-full text-start block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                Subir Certificados / Premios
                            </a>
                       
                       @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-start block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                {{ __('Cerrar sesión') }}
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Botones para usuarios no autenticados -->
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 dark:hover:bg-gray-700">
                        {{ __('Iniciar sesión') }}
                    </a>
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 dark:hover:bg-gray-700">
                            {{ __('Registrarse') }}
                        </a>
                    @endif
                </div>
            @endauth
        </div>
        
    </div>


    
</nav>



