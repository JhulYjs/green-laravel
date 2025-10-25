<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Muestra la lista de todos los usuarios.
     */
    public function index(): View
    {
        $usuarios = User::orderBy('fecha_registro', 'desc')->get();
        return view('admin.usuarios.index', [
            'usuarios' => $usuarios
        ]);
    }

    /**
     * Muestra el formulario para editar un usuario específico.
     * Adapta mostrarFormEditarUsuario
     */
    public function edit(User $usuario): View // Usamos Route Model Binding (cambié $user a $usuario)
    {
        // Laravel ya busca el usuario por nosotros.
        // Si no lo encuentra, dará un 404.

        return view('admin.usuarios.edit', [ // Nueva vista
            'usuario' => $usuario
        ]);
    }

    /**
     * Actualiza los datos de un usuario en la base de datos.
     * Adapta procesarEditarUsuario y actualizarUsuarioAdmin
     */
    public function update(Request $request, User $usuario): RedirectResponse // Usa Route Model Binding
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre_completo' => ['required', 'string', 'max:255'],
            // Aseguramos que el email sea único, ignorando el email actual del usuario que estamos editando
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('usuarios')->ignore($usuario->id)],
            'rol' => ['required', Rule::in(['usuario', 'admin'])], // Roles permitidos
        ]);

        // Evitar que el admin se quite el rol a sí mismo (opcional pero recomendado)
        if ($usuario->id === Auth::id() && $validatedData['rol'] !== 'admin') {
            return back()->with('status_error', 'Error: No puedes quitarte el rol de administrador a ti mismo.');
        }

        // Actualizar el usuario con los datos validados
        $usuario->update($validatedData);

        // Redirigir de vuelta al formulario de edición con mensaje de éxito
        return redirect()->route('admin.usuarios.edit', $usuario)
                         ->with('status_success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario de la base de datos.
     * Adapta procesarEliminarUsuario y eliminarUsuario
     */
    public function destroy(User $usuario): RedirectResponse // Usa Route Model Binding
    {
        // Evitar que un admin se elimine a sí mismo
        if ($usuario->id === Auth::id()) {
            return redirect()->route('admin.usuarios.index')
                             ->with('status_error', 'Error: No puedes eliminar tu propia cuenta de administrador.');
        }

        try {
            $usuario->delete();
            return redirect()->route('admin.usuarios.index')
                             ->with('status_success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            // Manejar error (podría fallar por claves foráneas si no están bien configuradas)
            report($e); // Loguea el error
            return redirect()->route('admin.usuarios.index')
                             ->with('status_error', 'Error al eliminar el usuario. Puede estar asociado a otros registros.');
        }
    }
}