<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 p-8 rounded-xl shadow-lg">
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Actualizar Contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-white">
            {{ __('Asegúrate de que tu cuenta esté usando una contraseña larga y aleatoria para mantenerla segura.') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        <!-- Current Password -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Contraseña Actual')" class="text-white" />
            <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2 text-red-400" />
        </div>

        <!-- New Password -->
        <div>
            <x-input-label for="update_password_password" :value="__('Nueva Contraseña')" class="text-white" />
            <x-text-input wire:model="password" id="update_password_password" name="password" type="password" class="mt-1 block w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Contraseña')" class="text-white" />
            <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                {{ __('Guardar') }}
            </x-primary-button>

            <x-action-message class="me-3" on="password-updated">
                {{ __('Guardado.') }}
            </x-action-message>
        </div>
    </form>
</section>
