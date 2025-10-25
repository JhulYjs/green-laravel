<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Para verificar el usuario
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verifica si el usuario está autenticado Y si su rol es 'admin'
        //    Usamos la columna 'rol' que definimos en el modelo User
        //    y en la migración
        if (!Auth::check() || Auth::user()->rol !== 'admin') {
            // 2. Si no es admin, redirige a la página principal (o muestra un error 403)
            // abort(403, 'Acceso denegado. Solo administradores.'); // Opción más estricta
            return redirect('/'); // Redirige a la home si no es admin
        }

        // 3. Si es admin, permite que la solicitud continúe
        return $next($request);
    }
}