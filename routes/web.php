<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;

use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ProfesionalController;

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TermsAndPoliciesController;
use App\Http\Controllers\AdminController;

Route::view('/', 'welcome');

Route::get('dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    
    
Route::post('/logout', function () {
    Auth::logout(); // Cierra la sesión
    return redirect('/'); // Redirige a la página de inicio
})->name('logout');

Route::get('/contacto', function () {
    return view('contacto'); // Assumes you have a 'contacto.blade.php' view
})->name('contacto');



// Rutas para GoogleController////

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/proveedor/profile/{user}', [GoogleController::class, 'showDoctorProfileForm'])->name('proveedor.profile');
Route::post('/proveedor/profile/{user}', [GoogleController::class, 'updateDoctorProfile']);
Route::post('/auth/set-role/{user}', [GoogleController::class, 'setRole'])->name('set-role');
Route::get('/auth/select-role/{user}', [GoogleController::class, 'selectRoleForm'])->name('select-role');


// Servicios
Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios');

// Profesionales
Route::get('/profesionales', [ProfesionalController::class, 'index'])->name('profesionales');



// Contacto
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');

Route::get('/proveedor/detalle/{proveedor}', [HomeController::class, 'show'])->name('proveedor.detalle');
Route::get('/profecional/{proveedorId}/upload-certificate', [HomeController::class, 'uploadCertificate'])->name('proveedor.upload-certificate');
Route::get('quienessomos', [TermsAndPoliciesController::class, 'QuienesSomos'])->name('quienes.somos');

Route::get('/terminos-y-condiciones', [TermsAndPoliciesController::class, 'showTermsAndConditions'])->name('terms');
Route::get('/politicas-de-acceso', [TermsAndPoliciesController::class, 'showAccessPolicies'])->name('policies');

Route::get('/admin/panel', [AdminController::class, 'index'])->name('admin');

require __DIR__.'/auth.php';
