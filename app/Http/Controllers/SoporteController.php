<?php

namespace App\Http\Controllers;

use App\Models\MensajeSoporte; // <-- Importa el nuevo modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Mantenemos Log por si acaso
use Illuminate\View\View;

class SoporteController extends Controller
{
    /**
     * Muestra la página de soporte/contacto.
     */
    public function index(): View
    {
        return view('pages.soporte'); // Asegúrate que esta vista exista
    }

    /**
     * Procesa el envío del formulario de soporte (AJAX) y guarda en la BD.
     */
    public function procesar(Request $request)
    {
        // Aseguramos que solo respondemos a solicitudes AJAX
        if (!$request->wantsJson()) {
            return response()->json(['success' => false, 'message' => 'Método no permitido.'], 405);
        }

        // 1. Validar los datos de entrada
        try {
            $validatedData = $request->validate([
                'full-name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'message' => ['required', 'string', 'max:1000'], // Ajusta el max si es necesario
            ], [
                // Mensajes de error personalizados (opcional)
                'full-name.required' => 'Por favor, completa el campo Nombre completo.',
                'email.required' => 'Por favor, ingresa tu email.',
                'email.email' => 'El formato del email no es válido.',
                'message.required' => 'Por favor, escribe tu mensaje.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Si la validación falla, devuelve un error 422 con el primer mensaje
             return response()->json([
                 'success' => false,
                 'message' => $e->validator->errors()->first() // Devuelve solo el primer error
             ], 422); // Código de error para validación fallida
        }

        // 2. Guardar el mensaje en la base de datos
        try {
            MensajeSoporte::create([
                'nombre_completo' => $validatedData['full-name'], // Usa el nombre validado del request
                'email' => $validatedData['email'],
                'mensaje' => $validatedData['message'],
                // 'leido' será false por defecto según la migración
            ]);

            // Simular un retraso de red como en el original (opcional)
            sleep(1);

            // 3. Devolver respuesta JSON de éxito
            return response()->json([
                'success' => true,
                'message' => '¡Gracias! Hemos recibido tu mensaje y te contactaremos pronto.'
            ]);

        } catch (\Exception $e) {
            // Manejar error al guardar en BD
            report($e); // Loguea el error completo en Laravel
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error interno al guardar tu mensaje. Intenta más tarde.'
            ], 500); // Error interno del servidor
        }
    }
}