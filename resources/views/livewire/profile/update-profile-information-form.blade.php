<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Gate;
use App\Models\Proveedor;
new class extends Component
{

    use WithFileUploads;  // Agregar este trait

    public $avatar;  // Variable para almacenar el archivo
    public $proveedor; 
  
    public string $name = '';
    public string $email = '';
    public bool $isProveedor = false;

    public string $specialty = '';
    public string $city = '';
    public int $experience_years = 0;
    public ?string $bio = null;
    public ?string $phone = null;

    public ?string $certifications = null;
    public ?string $education = null;
    public ?string $languages = null;
    public bool $verified = true;
    public ?string $location = null;
    
  
    




public ?string $consultation_hours = null;  // Horario de consulta

     // Disponibilidad como un array asociativo
     public array $availability = [
        'monday' => ['start' => '', 'end' => ''],
        'tuesday' => ['start' => '', 'end' => ''],
        'wednesday' => ['start' => '', 'end' => ''],
        'thursday' => ['start' => '', 'end' => ''],
        'friday' => ['start' => '', 'end' => ''],
    ];

    /**
     * Mount the component.
     */
     public function mount(): void
    {
        $this->proveedor = Proveedor::where('user_id', Auth::id())->first(); 
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;

    // Asigna los valores del usuario a las propiedades de Livewire
   
    $this->avatar = $user->avatar;
    $this->specialty = $user->specialty ?? ''; // Si es un doctor
    $this->city = $user->city ?? ''; // Si es un doctor
   // $this->experience_years = $user->experience_years; // Si es un doctor
    $this->bio = $user->bio ?? '';
    $this->phone = $user->phone ?? '';
    $this->availability = json_decode($user->availability, true) ?? [];
    $this->certifications = $user->certifications ?? '';
    $this->education = $user->education ?? '';
    $this->languages = $user->languages ?? '';
    $this->location = $user->location ?? '';
 
 
   
    

        

        // Verificar si el usuario tiene un registro en la tabla 'doctors'
        if ($user->proveedor) {
            $this->isProveedor = true;

            $this->specialty = $user->proveedor->specialty;
            $this->city = $user->proveedor->city;
            $this->experience_years = $user->proveedor->experience_years;
            $this->bio = $user->proveedor->bio;
           $this->phone = $user->proveedor->phone;
             // Decodificar la disponibilidad del JSON almacenado
      
        $this->availability = json_decode($user->proveedor->availability, true) ?? [
            'monday' => ['start' => '', 'end' => ''],
            'tuesday' => ['start' => '', 'end' => ''],
            'wednesday' => ['start' => '', 'end' => ''],
            'thursday' => ['start' => '', 'end' => ''],
            'friday' => ['start' => '', 'end' => ''],
        ];
       // $this->availability = json_decode($user->availability, true) ?? [];
    $this->certifications = $user->proveedor->certifications ?? '';
    $this->education = $user->proveedor->education ?? '';
    $this->languages = $user->proveedor->languages ?? '';
    $this->location = $user->proveedor->location ?? '';
  
 

        }
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
     public function updateProfileInformation(): void
{
    try {

        $user = Auth::user();

        // Verifica si el usuario tiene permiso para actualizar el doctor
       // if (! Gate::allows('update-doctor', $user->doctor)) {
        //    abort(403, 'No tienes permiso para actualizar este doctor.');
        //}

        // Validar campos base
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'bio' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:15'],
           'availability' => ['nullable', 'array'],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de avatar

            // Nuevos campos
            'certifications' => ['nullable', 'string'],
            'education' => ['nullable', 'string'],
            'languages' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],
           
          
        ]);

        // Guardar datos del usuario
        $user->fill($validated);

        // Si se ha cargado un nuevo avatar
        if ($this->avatar) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Si el usuario es proveedor, actualizar la información
        if ($this->isProveedor) {
            $proveedorValidated = $this->validate([
                'specialty' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'bio' => ['nullable', 'string'],
                 'phone' => ['nullable', 'string', 'max:15'],
                'experience_years' => ['required', 'integer', 'min:0'],
                'availability' => ['nullable', 'array'],
                'location' => ['nullable', 'string'],
                
            ]);

            // Convertimos la disponibilidad a JSON antes de guardar
            $proveedorValidated['specialty'] = $this->specialty;
            $proveedorValidated['city'] = $this->city;
            $proveedorValidated['bio'] = $this->bio;
            $proveedorValidated['phone'] = $this->phone;
            $proveedorValidated['experience_years'] = $this->experience_years;
           $proveedorValidated['availability'] = json_encode($this->availability);
          


            $proveedorValidated['certifications'] = $this->certifications;
            $proveedorValidated['education'] = $this->education;
            $proveedorValidated['languages'] = $this->languages;
            $proveedorValidated['location'] = $this->location;
            $verified=  $this->verified;
            // Actualizar el modelo del doctor
            $user->proveedor->update($proveedorValidated);
        }

        $user->save();

        session()->flash('success', 'La información del perfil se ha actualizado correctamente.');
    } catch (\Exception $e) {
        session()->flash('error', 'Ocurrió un error al actualizar la información del perfil: ' . $e->getMessage());
    }
}




    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 p-8 rounded-xl shadow-lg">
    
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Información del Perfil') }}
        </h2>
        <p class="mt-1 text-sm text-white">
            {{ __("Actualiza la información de tu cuenta y la dirección de correo electrónico.") }}
        </p>
    </header>

    <form wire:submit.prevent="updateProfileInformation" class="mt-6 space-y-6">
        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" class="text-white" />
            <x-text-input wire:model="name" id="name" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        <!-- Correo Electrónico -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-white" />
            <x-text-input wire:model="email" id="email" type="email" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>
        <div>
            <x-input-label for="avatar" :value="__('Avatar')" class="text-white" />
            <input type="file" wire:model="avatar" id="avatar" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('avatar')" class="mt-2 text-red-400" />
        
            @if ($avatar && is_object($avatar))
                <!-- Vista previa para archivo temporal -->
                <div class="mt-2">
                    <p class="text-white">Vista previa:</p>
                    <img src="{{ $avatar->temporaryUrl() }}" class="mt-2 w-24 h-24 rounded-full" alt="Vista previa del avatar">
                </div>
            @elseif (filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL))
                <!-- Avatar almacenado como URL (por ejemplo, de Google) -->
                <div class="mt-2">
                    <p class="text-white">Avatar actual:</p>
                    <img src="{{ Auth::user()->avatar }}" class="mt-2 w-24 h-24 rounded-full" alt="Avatar actual">
                </div>
            @elseif (Auth::user()->avatar && file_exists(public_path('storage/avatars/' . Auth::user()->avatar)))
                <!-- Avatar almacenado como archivo en public/avatars -->
                <div class="mt-2">
                    <p class="text-white">Avatar actual:</p>
                    <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" class="mt-2 w-24 h-24 rounded-full" alt="Avatar actual">
                </div>
            @else
                <!-- Sin avatar -->
                <div class="mt-2">
                    <p class="text-white">Avatar no disponible:</p>
                    <img src="https://via.placeholder.com/300" class="mt-2 w-24 h-24 rounded-full" alt="Avatar no disponible">
                </div>
            @endif
        </div>
        
        

      
        @if ($isProveedor)
            <div>
                <x-input-label for="specialty" :value="__('Especialidad')" class="text-white" />
                <x-text-input wire:model="specialty" id="specialty" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('specialty')" class="mt-2 text-red-400" />
            </div>

            <div>
                <x-input-label for="city" :value="__('Ciudad')" class="text-white" />
                <x-text-input wire:model="city" id="city" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('city')" class="mt-2 text-red-400" />
            </div>

            <div>
                <x-input-label for="experience_years" :value="__('Años de experiencia')" class="text-white" />
                <x-text-input wire:model="experience_years" id="experience_years" type="number" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('experience_years')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-4">
                <x-input-label for="bio" :value="__('Bio')" class="text-white" />
                <textarea wire:model="bio" id="bio" class="block mt-1 w-full rounded-md"></textarea>
                <x-input-error :messages="$errors->get('bio')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-4">
                <x-input-label for="phone" :value="__('Teléfono')" class="text-white" />
                <x-text-input wire:model="phone" id="phone" type="text" class="block mt-1 w-full rounded-md" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-red-400" />
            </div>
            <div class="mt-4">
                <x-input-label for="location" :value="__('Ubicacion')" class="text-white" />
                <x-text-input wire:model="location" id="location" type="text" class="block mt-1 w-full rounded-md" />
                <x-input-error :messages="$errors->get('location')" class="mt-2 text-red-400" />
            </div>

         
            <div class="mt-4">
                <x-input-label for="availability" :value="__('Disponibilidad')" class="text-white" />
                <div class="space-y-4">
                    @foreach (['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miércoles', 'thursday' => 'Jueves', 'friday' => 'Viernes'] as $day => $label)
                        <div class="flex items-center gap-4">
                            <label>
                                <input 
                                    wire:model="availability.{{ $day }}.active" 
                                    type="checkbox" 
                                    @if (!empty($availability[$day]['start']) && !empty($availability[$day]['end'])) checked @endif
                                /> 
                                {{ $label }}
                            </label>
                            <div class="flex items-center gap-2">
                                <x-text-input 
                                    wire:model="availability.{{ $day }}.start" 
                                    type="time" 
                                    class="mt-1 block w-24"
                                    value="{{ $availability[$day]['start'] ?? '' }}" 
                                    placeholder="Inicio"
                                />
                                <x-text-input 
                                    wire:model="availability.{{ $day }}.end" 
                                    type="time" 
                                    class="mt-1 block w-24"
                                    value="{{ $availability[$day]['end'] ?? '' }}" 
                                    placeholder="Fin"
                                />
                            </div>
                        </div>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('availability')" class="mt-2 text-red-400" />


            </div>



            <div class="mt-4">
                <x-input-label for="certifications" :value="__('Certificaciones')" class="text-white" />
                <x-text-input wire:model="certifications" id="certifications" type="text" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('certifications')" class="mt-2 text-red-400" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="education" :value="__('Educación')" class="text-white" />
                <x-text-input wire:model="education" id="education" type="text" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('education')" class="mt-2 text-red-400" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="languages" :value="__('Idiomas')" class="text-white" />
                <x-text-input wire:model="languages" id="languages" type="text" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('languages')" class="mt-2 text-red-400" />
            </div>

  


     @endif

     
               @if (session()->has('success'))
               <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
             {{ session('success') }}
                </div>
                 @endif
 
             @if (session()->has('error'))
             <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
         {{ session('error') }}
              </div>
            @endif

        <!-- Botón Guardar -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>
            <x-action-message on="profile-updated" class="dark:text-emerald-50">
                {{ __('Guardado.') }}
            </x-action-message>
        </div>
    </form>
       <br>
       @if (Auth::check() && Auth::user()->role === 'proveedor')
       <div class="mb-4 p-4 bg-gray-100 rounded-md">
           <p class="text-lg font-semibold text-gray-800">
               Puedes subir tus certificados, logros o reconocimientos aquí.
           </p>
   
           <a href="{{ route('proveedor.upload-certificate', $proveedor->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition duration-300 ease-in-out">
               Subir Certificado
           </a>
       </div>
   @endif
   
    
   
</section>


{{-- 
  <div class="mt-4">
                <x-input-label for="average_rating" :value="__('Promedio de Calificación')" class="text-white" />
                <x-text-input wire:model="average_rating" id="average_rating" type="number" step="0.1" min="0" max="5" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('average_rating')" class="mt-2 text-red-400" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="reviews_count" :value="__('Número de Reseñas')" class="text-white" />
                <x-text-input wire:model="reviews_count" id="reviews_count" type="number" min="0" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('reviews_count')" class="mt-2 text-red-400" />
            </div>

--}}