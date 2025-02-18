<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Proveedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    //

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            // Obtener los datos del usuario desde Google
            $googleUser = Socialite::driver('google')->stateless()->user();
    
            // Buscar al usuario existente por `external_id` y `external_auth`
            $user = User::where('external_id', $googleUser->getId())
                        ->where('external_auth', 'google')
                        ->first();
    
            if (!$user) {
                // Verificar si el correo ya existe
                $user = User::where('email', $googleUser->getEmail())->first();
    
                if ($user) {
                    // Actualizar los datos del usuario existente
                    $user->update([
                        'external_id' => $googleUser->getId(),
                        'external_auth' => 'google',
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                } else {
                    // Crear un nuevo usuario
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'avatar' => $googleUser->getAvatar(),
                        'external_id' => $googleUser->getId(),
                        'external_auth' => 'google',
                        'google_id' => $googleUser->getId(),
                        'password' => Hash::make(uniqid()), // Contraseña aleatoria
                        'registered' => true,
                    ]);
                }
            }
    
            // Si el usuario no tiene un rol asignado, mostrar formulario
            if (!$user->role) {
                return view('auth.select-role', ['user' => $user]);
            }
    
            // Iniciar sesión con el usuario
            Auth::login($user);
    
            // Redirigir al dashboard
            return redirect()->route('dashboard');
    
        } catch (\Exception $e) {
            // Manejar errores y redirigir con un mensaje
            return redirect()->route('login')->with('error', 'Ocurrió un error durante el registro. Inténtalo nuevamente.');
        }
    }
    
   
    
    
public function selectRoleForm()
{
    // Obtén el usuario autenticado
    $user = auth()->user();

    // Lógica para mostrar el formulario de selección de rol
    return view('auth.select-role', compact('user'));
}
public function setRole(Request $request, $userId)
{
    $request->validate([
        'role' => ['required', 'in:proveedor,client']
    ]);

    // Buscar el usuario por su ID
    $user = User::findOrFail($userId);

    // Actualizar el rol del usuario
    $user->role = $request->role;

    // Asignar el rol utilizando Spatie Laravel Permission
    $user->assignRole($request->role);

  

    // Iniciar sesión con el usuario
    Auth::login($user);

    // Si el usuario es doctor, redirigir a completar su perfil
    if ($request->role === 'proveedor') {
        return redirect()->route('proveedor.profile', ['user' => $user->id]);
    }

    // Redirigir al dashboard si es paciente
    return redirect()->route('dashboard');
}


public function showDoctorProfileForm(User $user)
{
    return view('auth.proveedor-profile', compact('user'));
}

public function updateDoctorProfile(Request $request, User $user)
{
    $validated = $request->validate([
        'specialty' => ['required', 'string', 'max:255'],
        'city' => ['required', 'string', 'max:255'],
        'experience_years' => ['required', 'integer', 'min:0'],
      //  'photo' => ['nullable', 'image', 'max:1024'],
        'bio' => ['nullable', 'string', 'max:500'],
        'phone' => ['nullable', 'string', 'max:15'],
        'availability' => ['nullable', 'array'],

      
    ]);

    // Guardar los datos del doctor
    Proveedor::create([
        'user_id' => $user->id,
        'specialty' => $validated['specialty'],
        'city' => $validated['city'],
        'experience_years' => $validated['experience_years'],
      //  'photo' => $validated['photo'] ? $validated['photo']->store('doctor_photos', 'public') : null,
        'bio' => $validated['bio'],
        'phone' => $validated['phone'],
        'availability' => json_encode($validated['availability']),

    ]);

    // Redirigir al dashboard
    return redirect()->route('dashboard');
}

}
