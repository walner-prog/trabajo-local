<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

    <?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>


<nav x-data="{ open: false }" class="bg-white w-24 dark:bg-gray-900 fixed w-full z-20 top-0 start-0  dark:border-gray-600">
    <!-- Primary Navigation Menu -->
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto ">
        <a href="{{ route('dashboard') }}" class="flex items-start space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/logo.png') }}" 
                 class="h-25 w-20 transition-transform duration-300 hover:scale-110" 
                 alt="logo">
        </a>
        
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

            <div x-data="{ open: false }" class="md:hidden">
                <!-- Menu Toggle Button -->
            
                <button @click="open = !open" 
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 ">
                <span class="sr-only">Open main menu</span>
                <svg x-show="!open" class="w-5 h-5 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
                <svg x-show="open" class="w-5 h-5 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                 </button>


                 <div 
                 x-show="open"
                 x-transition:enter="transform transition-transform ease-in-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition-transform ease-in-out duration-300"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="fixed top-20 right-0 w-3/4 h-full bg-white shadow-md z-60 dark:bg-gray-800 md:hidden"
                 x-cloak
             >


                
            
                <!-- Responsive Menu -->
                <div x-show="open" class="mt-2 space-y-1 bg-white    dark:bg-gray-800 dark:border-gray-700" x-cloak>
                    <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
                        {{ __('Inicio') }}
                       </a>
                      
                        <a href="{{ route('quienes.somos') }}"  class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
                            {{ __('Quienes Somos') }}
                        </a>

                        <a href="{{ route('servicios') }}" class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
                            {{ __('Servicios') }}
                        </a>
                    
                        <!-- Enlace: Profesionales -->
                        <a href="{{ route('profesionales') }}" class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
                            {{ __('Profesionales') }}
                        </a>
                    
                        <!-- Enlace: Quiénes Somos -->
                        <a href="{{ route('quienes.somos') }}" class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
                            {{ __('Quiénes Somos') }}
                        </a>
                    
                        <!-- Enlace: Contacto -->
                        <a href="{{ route('contacto') }}" class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
                            {{ __('Contacto') }}
                        </a>
                    
                     
                       @auth
                    <!-- Opciones para usuarios autenticados -->
                    <a href="{{ route('profile') }}"  class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
                        {{ __('Perfil') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
                            {{ __('Cerrar') }}
                        </button>
                    </form>
                    
                    
                @else
                    <!-- Opciones para usuarios no autenticados -->
                    <a href="{{ route('login') }}"  class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
                        {{ __('Iniciar') }}
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"  class="block text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg px-3 py-2 mb-4">
                            {{ __('Registrarse') }}
                        </a>
                    @endif
                @endauth
               
                </div>
            </div>
            
        </div>
          <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <div class="flex">
            
            

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link 
    :href="route('dashboard')" 
    :active="request()->routeIs('dashboard')" 
    wire:navigate
    class="text-gray-700 dark:text-gray-300 py-2 rounded-lg relative 
           after:content-[''] after:absolute after:bottom-0 after:left-0 
           after:w-0 after:h-0.5 after:bg-indigo-500 
           hover:after:w-full hover:after:transition-all hover:after:duration-300 
           {{ request()->routeIs('dashboard') ? 'after:w-full' : '' }}">
    {{ __('Inicio') }}
</x-nav-link>


   <!-- Enlace: Servicios -->
<x-nav-link 
:href="route('servicios')" 
:active="request()->routeIs('servicios')" 
wire:navigate
class="text-gray-700 dark:text-gray-300 py-2 rounded-lg relative 
       after:content-[''] after:absolute after:bottom-0 after:left-0 
       after:w-0 after:h-0.5 after:bg-indigo-500 
       hover:after:w-full hover:after:transition-all hover:after:duration-300 
       {{ request()->routeIs('servicios') ? 'after:w-full' : '' }}">
{{ __('Servicios') }}
</x-nav-link>

<!-- Enlace: Profesionales -->
<x-nav-link 
:href="route('profesionales')" 
:active="request()->routeIs('profesionales')" 
wire:navigate
class="text-gray-700 dark:text-gray-300 py-2 rounded-lg relative 
       after:content-[''] after:absolute after:bottom-0 after:left-0 
       after:w-0 after:h-0.5 after:bg-indigo-500 
       hover:after:w-full hover:after:transition-all hover:after:duration-300 
       {{ request()->routeIs('profesionales') ? 'after:w-full' : '' }}">
{{ __('Profesionales') }}
</x-nav-link>

<!-- Enlace: Quiénes Somos -->
<x-nav-link 
:href="route('quienes.somos')" 
:active="request()->routeIs('quienes.somos')" 
wire:navigate
class="text-gray-700 dark:text-gray-300 py-2 rounded-lg relative 
       after:content-[''] after:absolute after:bottom-0 after:left-0 
       after:w-0 after:h-0.5 after:bg-indigo-500 
       hover:after:w-full hover:after:transition-all hover:after:duration-300 
       {{ request()->routeIs('quienes.somos') ? 'after:w-full' : '' }}">
{{ __('Quiénes Somos') }}
</x-nav-link>

<!-- Enlace: Contacto -->
<x-nav-link 
:href="route('contacto')" 
:active="request()->routeIs('contacto')" 
wire:navigate
class="text-gray-700 dark:text-gray-300 py-2 rounded-lg relative 
       after:content-[''] after:absolute after:bottom-0 after:left-0 
       after:w-0 after:h-0.5 after:bg-indigo-500 
       hover:after:w-full hover:after:transition-all hover:after:duration-300 
       {{ request()->routeIs('contacto') ? 'after:w-full' : '' }}">
{{ __('Contacto') }}
</x-nav-link>

                
                </div>
            </div>

           
       

             

                

                            @auth
                                <!-- Opciones para usuarios autenticados -->
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                    {{ __('Dashboard') }}
                                </a>
                                <button wire:click="logout" class="w-full text-start px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                    {{ __('Cerrar') }}
                                </button>
                             @else
                                <!-- Opciones para usuarios no autenticados -->
                                <a href="{{ route('login') }}" class="block px-4 py-2 ml-6 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-700">
                                    {{ __('Iniciar sesión') }}
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="block px-4 ml-6 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-700">
                                        {{ __('Registrarse') }}
                                    </a>
                                @endif
                            @endauth
                      
               
                
            </div>
            <!-- Hamburger -->
           
       
        </div>
    </div>

  

</nav>
</body>
</html>

