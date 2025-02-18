<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TermsAndPoliciesController extends Controller
{
    // Método para mostrar los Términos y Condiciones
    public function showTermsAndConditions()
    {
        return view('legalidad.termino');
    }

    // Método para mostrar las Políticas de Acceso
    public function showAccessPolicies()
    {
        return view('legalidad.politica');
    }

    public function QuienesSomos()
    {
        // Obtener el usuario autenticado
      //  $user = auth()->user();
    
        // Verificar si el usuario está registrado (campo 'registered' es true)
       // $isRegistered = $user && $user->registered;
    
        // Pasar la variable a la vista
        return view('legalidad.quienessomos');
    }
    
    
}
