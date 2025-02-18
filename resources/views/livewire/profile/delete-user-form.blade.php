<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="bg-gradient-to-r from-red-500 via-orange-500 to-yellow-600 p-8 rounded-xl shadow-lg space-y-6">
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Eliminar Cuenta') }}
        </h2>

        <p class="mt-1 text-sm text-white">
            {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos se eliminarán permanentemente. Antes de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
    >{{ __('Eliminar Cuenta') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6 bg-white rounded-xl shadow-lg">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('¿Estás seguro de que deseas eliminar tu cuenta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos se eliminarán permanentemente. Por favor, ingresa tu contraseña para confirmar que deseas eliminar permanentemente tu cuenta.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />

                <x-text-input
                    wire:model="password"
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-gray-800 dark:text-white"
                    placeholder="{{ __('Contraseña') }}"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-6 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    {{ __('Eliminar Cuenta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

