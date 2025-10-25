<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria; // Necesitamos Categoría para el formulario de edición
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse; // Para type hinting
use Illuminate\Validation\Rule;       // Para reglas de validación
use Illuminate\Support\Facades\Storage; // Para manejar archivos (si implementáramos subida/borrado)
use Illuminate\Support\Facades\Auth; // <-- AÑADE ESTA LÍNEA


class AdminProductoController extends Controller
{
    /**
     * Muestra la lista de todos los productos.
     */
    public function index(): View
    {
        $productos = Producto::query()
            ->with('usuario')
            ->latest('fecha_creacion')
            ->get();

        return view('admin.productos.index', [
            'productos' => $productos
        ]);
    }
    public function create(): View // NUEVO MÉTODO
    {
        $categorias = Categoria::orderBy('nombre')->get(); // Necesitamos las categorías

        return view('admin.productos.create', [ // Nueva vista
            'categorias' => $categorias
        ]);
    }

    /**
     * Guarda un nuevo producto en la base de datos (admin).
     * Reemplaza procesarSubida y crearProducto
     */
    public function store(Request $request): RedirectResponse // NUEVO MÉTODO
    {
        // Validar los datos del formulario, incluyendo la imagen
        $validatedData = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'precio' => ['required', 'numeric', 'min:0.01'],
            'precio_oferta' => ['nullable', 'numeric', 'min:0.01', 'lt:precio'],
            'talla' => ['required', 'string', 'max:50'],
            'estado' => ['required', Rule::in(['Nuevo', 'Como nuevo', 'Buen estado', 'Usado'])],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'imagen' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'], // Máx 5MB (5120 KB)
        ]);

        // Manejar la subida de la imagen
        if ($request->hasFile('imagen')) {
            // Guarda la imagen en storage/app/public/uploads/products y devuelve la ruta relativa
            // Asegúrate de ejecutar `php artisan storage:link` una vez para crear el enlace simbólico
            $path = $request->file('imagen')->store('uploads/products', 'public'); 
            // Guardamos la ruta relativa que se puede usar con asset()
            $validatedData['imagen_url'] = $path; 
        } else {
             // Esto no debería pasar si la validación 'required' funciona, pero por si acaso
             return back()->with('status_error', 'Error: No se subió ninguna imagen.');
        }


        // Asegurarse de que precio_oferta sea null si está vacío o es 0
        $validatedData['precio_oferta'] = !empty($validatedData['precio_oferta']) && $validatedData['precio_oferta'] > 0 ? $validatedData['precio_oferta'] : null;
        
        // Opcional: Asignar el ID del administrador actual como vendedor
        $validatedData['usuario_id'] = Auth::id(); 

        // Crear el producto en la base de datos
        try {
             Producto::create($validatedData);

             // Redirigir a la lista de productos con mensaje de éxito
            return redirect()->route('admin.productos.index')
                             ->with('status_success', 'Producto agregado correctamente.');

        } catch (\Exception $e) {
             // Si falla la creación en BD, intentar borrar la imagen subida
             if (isset($path)) {
                 Storage::disk('public')->delete($path);
             }
             report($e); // Loguea el error
             return back()->with('status_error', 'Error al guardar el producto en la base de datos.')
                        ->withInput(); // Devuelve los datos ingresados al formulario
        }
    }
    /**
     * Muestra el formulario para editar un producto específico (admin).
     * Adapta mostrarFormEditarProducto
     */
    public function edit(Producto $producto): View // Usa Route Model Binding
    {
        // Laravel ya busca el producto. Si no existe, da 404.
        $categorias = Categoria::orderBy('nombre')->get(); // Obtenemos categorías para el select

        return view('admin.productos.edit', [ // Nueva vista
            'producto' => $producto,
            'categorias' => $categorias
        ]);
    }

    /**
     * Actualiza un producto específico en la base de datos (admin).
     * Adapta procesarEditarProducto y actualizarProductoAdmin
     */
    public function update(Request $request, Producto $producto): RedirectResponse // Usa Route Model Binding
    {
        // Validar los datos del formulario (similar a ProductoController::update, pero sin verificar usuario_id)
        $validatedData = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'precio' => ['required', 'numeric', 'min:0.01'],
            'precio_oferta' => ['nullable', 'numeric', 'min:0.01', 'lt:precio'],
            'talla' => ['required', 'string', 'max:50'],
            'estado' => ['required', Rule::in(['Nuevo', 'Como nuevo', 'Buen estado', 'Usado'])],
            'categoria_id' => ['required', 'exists:categorias,id'],
            // No validamos imagen aquí
        ]);

        // Asegurarse de que precio_oferta sea null si está vacío o es 0
        $validatedData['precio_oferta'] = !empty($validatedData['precio_oferta']) && $validatedData['precio_oferta'] > 0 ? $validatedData['precio_oferta'] : null;

        // Actualizar el producto
        $producto->update($validatedData);

        // Redirigir de vuelta al formulario de edición con mensaje de éxito
        return redirect()->route('admin.productos.edit', $producto)
                         ->with('status_success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina un producto específico de la base de datos (admin).
     * Adapta procesarEliminarProducto y adminEliminarProducto
     */
    public function destroy(Producto $producto): RedirectResponse // Usa Route Model Binding
    {
        // Obtener la ruta de la imagen ANTES de borrar el registro
        $imagenPath = $producto->imagen_url;

        try {
            // Eliminar el producto de la base de datos
            $producto->delete();

            // Intentar eliminar el archivo de imagen del almacenamiento público si existe
            if ($imagenPath) {
                $publicPath = public_path($imagenPath);
                if (file_exists($publicPath)) {
                    @unlink($publicPath); // Usamos @ para suprimir errores si no se puede borrar
                }
            }

            return redirect()->route('admin.productos.index')
                             ->with('status_success', 'Producto eliminado correctamente.');
        } catch (\Exception $e) {
            // Manejar error (ej. si el producto está en un detalle_pedido y no hay ON DELETE SET NULL)
            report($e); // Loguea el error
            // Comprobar si es un error de clave foránea (código 1451 en MySQL)
            if ($e instanceof \Illuminate\Database\QueryException && $e->getCode() === '23000') {
                 return redirect()->route('admin.productos.index')
                                 ->with('status_error', 'Error: No se puede eliminar el producto porque está referenciado en uno o más pedidos.');
            }
            return redirect()->route('admin.productos.index')
                             ->with('status_error', 'Error al eliminar el producto.');
        }
    }
}