<?php

use App\Models\User;
use App\Models\Proveedor;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Laravel\Socialite\Facades\Socialite;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
public string $email = '';
public string $password = '';
public $avatar;
public string $password_confirmation = '';
public string $userRole = 'client'; // Asignamos por defecto el rol cliente, pero se puede cambiar a proveedor

public string $specialty = '';
public string $city = '';
public int $experience_years = 0;
public $photo;
public string $bio = '';
public string $phone = '';
public array $availability = [];
public string $location= '';
public string $certifications = ''; // Nuevo campo
public string $education = ''; // Nuevo campo
public string $languages = ''; // Nuevo campo




  public function register()
 {
       try {
        // Validar los datos de entrada
        
         $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'userRole' => ['required', 'in:proveedor,client'], // Validar los roles permitidos
            'phone' => ['nullable', 'string', 'max:15'],
        ]);

        // Guardar la imagen si se sube
        $avatarPath = null;
        if ($this->avatar) {
            $avatarPath = $this->avatar->store('avatars', 'public');
        }

        // Validar los campos adicionales si es un proveedor
        if ($this->userRole === 'proveedor') {
            $this->validate([
                'specialty' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'experience_years' => ['required', 'integer', 'min:0'],
                'bio' => ['nullable', 'string', 'max:500'],
                'location' => ['nullable', 'string', 'max:255'],
                'certifications' => ['nullable', 'string', 'max:500'], // Validación para certifications
                'education' => ['nullable', 'string', 'max:500'], // Validación para education
                'languages' => ['nullable', 'string', 'max:500'], 
               // 'availability' => ['nullable', 'array'],// Validación para languages
            ]);
        }

        // Hashear la contraseña
        $validated['password'] = Hash::make($validated['password']);

        // Crear el usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'avatar' => $avatarPath,
            'registered' => true,
            'role' => $this->userRole, // Guardamos el rol asignado
            'phone' => $this->phone,
        ]);

        // Si es proveedor, crear la entrada correspondiente en la tabla 'proveedores'
        if ($this->userRole === 'proveedor') {
            Proveedor::create([
                'user_id' => $user->id,
                'specialty' => $this->specialty,
                'city' => $this->city,
                'experience_years' => $this->experience_years,
                'bio' => $this->bio,
                 'location' => $this->location,
                'certifications' => $this->certifications,
                'education' => $this->education,
                'languages' => $this->languages,
                'verified' => true,  // Puedes cambiar esto si es necesario
                //'availability' => json_encode($this->availability),
            ]);
        }

        

        // Asignar el rol
        $user->assignRole($this->userRole);

        // Disparar el evento de registro
        event(new Registered($user));

        // Iniciar sesión con el nuevo usuario
        Auth::login($user);

        // Mensaje de éxito
        session()->flash('message', '¡Registro exitoso!');

        // Redirigir al dashboard
        $this->redirect(route('dashboard'));

    } catch (\Exception $e) {
        // Manejo de errores
        session()->flash('error', 'Hubo un error durante el registro: ' . $e->getMessage());
    }
}


   public function redirectToGoogle()
    {
        return redirect(Socialite::driver('google')->stateless()->redirect()->getTargetUrl());
    }

    /**
     * Manejar la respuesta de Google y registrar o autenticar al usuario.
     */
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'registered' => true, // Marcar como registrado
                'password' => Hash::make(uniqid()), // Contraseña aleatoria segura
            ]
        );

        $user->assignRole('client'); // Rol predeterminado
        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

}; ?>

<div class="max-w-md mx-auto bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 p-8 rounded-xl shadow-lg">


    @if (session('error'))
    <div class="alert alert-danger bg-red-500 text-slate-50 p-2">
        {{ session('error') }}
    </div>
  @endif

   @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
  @endif

    <form wire:submit="register" class="space-y-6" enctype="multipart/form-data">
        @csrf
     
     <!-- Nombre -->
     <div>
        <x-input-label for="name" :value="__('Nombre')" class="text-white" />
        <x-text-input wire:model="name" id="name" class="block mt-1 w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" type="text" name="name" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
    </div>

    <!-- Dirección de correo electrónico -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Correo Electrónico')" class="text-white" />
        <x-text-input wire:model="email" id="email" class="block mt-1 w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" type="email" name="email" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
    </div>

    <!-- Contraseña -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Contraseña')" class="text-white" />
        <x-text-input wire:model="password" id="password" class="block mt-1 w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" type="password" name="password" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
    </div>

    <!-- Confirmar Contraseña -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-white" />
        <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" type="password" name="password_confirmation" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
    </div>

    <!-- Teléfono -->
    <div class="mt-4">
        <x-input-label for="phone" :value="__('Teléfono')" class="text-white" />
        <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" type="text" />
        @error('phone')
        <div class="mt-2 text-red-400">{{ $message }}</div>
        @enderror
    </div>


        <!-- Selector de Rol (Doctor o Paciente) -->
        <div>
            <label class="text-white">¿Eres Proveedor de un servicio?</label>
            <input wire:model="userRole" type="radio" value="proveedor" class="mr-2" /> Sí
            <input wire:model="userRole" type="radio" value="client" class="mr-2" /> No
        </div>

        <!-- Campos de doctor, visibles si el usuario es proveedor -->
        @if ($userRole === 'proveedor')
            <div class="mt-4">
                <x-input-label for="specialty" :value="__('Especialidad')" class="text-white" />
                <x-text-input wire:model="specialty" id="specialty" class="block mt-1 w-full" type="text" required />
            </div>

            <div class="mt-4">
                <x-input-label for="city" :value="__('Ciudad')" class="text-white" />
                <x-text-input wire:model="city" id="city" class="block mt-1 w-full" type="text" required />
            </div>

            <div class="mt-4">
                <x-input-label for="experience_years" :value="__('Años de Experiencia')" class="text-white" />
                <x-text-input wire:model="experience_years" id="experience_years" class="block mt-1 w-full" type="number" required />
            </div>

            <div class="mt-4">
                <x-input-label for="bio" :value="__('Biografía')" class="text-white" />
                <textarea wire:model="bio" id="bio" class="block mt-1 w-full" rows="4"></textarea>
            </div>

            <div class="mt-4">
                <x-input-label for="location" :value="__('Ubicacion')" class="text-white" />
                <x-text-input wire:model="location" id="location" class="block mt-1 w-full" type="text" required />
            </div>

            

          

            <div class="mt-4">
                <x-input-label for="certifications" :value="__('Certificaciones')" class="text-white" />
                <x-text-input wire:model="certifications" id="certifications" class="block mt-1 w-full" type="text" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="education" :value="__('Educación')" class="text-white" />
                <x-text-input wire:model="education" id="education" class="block mt-1 w-full" type="text" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="languages" :value="__('Idiomas')" class="text-white" />
                <x-text-input wire:model="languages" id="languages" class="block mt-1 w-full" type="text" />
            </div>

        @endif

        <div class="mt-6">
            <a href="{{ route('auth.google') }}" class="flex items-center bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg">
                <!-- Imagen del logo -->
                <img src="{{ asset('images/google.png') }}" alt="Logo de Google" class="w-6 h-6 mr-2">
                <!-- Texto del botón -->
                {{ __('Iniciar sesión con Google') }}
            </a>
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-200 hover:text-gray-100 dark:hover:text-gray-400" href="{{ route('login') }}" wire:navigate>
                {{ __('¿Ya tienes una cuenta?') }}
            </a>

            <x-primary-button class="ms-4 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</div>
