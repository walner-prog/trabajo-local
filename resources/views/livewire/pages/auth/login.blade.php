<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;


new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="max-w-md mx-auto bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 p-8 rounded-xl shadow-lg">
    <!-- Estado de sesión -->
    <x-auth-session-status class="mb-4 bg-sky-600 text-slate-300" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        <!-- Dirección de correo -->
        <div>
            <x-input-label for="email" :value="'Correo electrónico'" class="text-white" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-red-400" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="'Contraseña'" class="text-white" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-red-400" />
        </div>

        <!-- Recordarme -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center text-white">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-200 dark:text-gray-400">Recordarme</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-200 hover:text-gray-100 dark:hover:text-gray-400" href="{{ route('password.request') }}" wire:navigate>
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <x-primary-button class="ms-3 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Iniciar sesión
            </x-primary-button>
        </div>
    </form>

    <!-- Botón de inicio de sesión con Google -->
    <div class="mt-6">
        <a href="{{ route('auth.google') }}" class="flex items-center bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg">
            <!-- Imagen del logo -->
            <img src="{{ asset('images/google.png') }}" alt="Logo de Google" class="w-6 h-6 mr-2">
            <!-- Texto del botón -->
            {{ __('Iniciar sesión con Google') }}
        </a>
    </div>
</div>



