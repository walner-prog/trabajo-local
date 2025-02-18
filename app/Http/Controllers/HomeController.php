<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    
    public function index()
    {
       
        return view('dashboard');
      


    }

    public function show($user)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Debe iniciar sesión para acceder a esta página.']);
        }
        
        $proveedor = Proveedor::where('user_id', $user)->first();
    
        if (!$proveedor) {
            abort(404);
        }
    
        return view('proveedore.show', compact('proveedor'));
    }

    public function uploadCertificate()
    {
        $proveedor = Proveedor::where('user_id', Auth::id())->first();
        
        if ($proveedor) {
            // Si se encuentra el doctor, pasa los datos a la vista
            return view('proveedore.certificados_logros', compact('proveedor'));
        }
    
        // Si no se encuentra el doctor, redirige al login
        return redirect()->route('login')->withErrors('Debes iniciar sesión para continuar.');
    }


    
   
}
