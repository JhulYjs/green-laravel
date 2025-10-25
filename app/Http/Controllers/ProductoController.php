<?php

namespace App\Http\Controllers;

use App\Models\Categoria; // Necesitamos Categoría para el formulario de edición
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Para manejar archivos (eliminar imagen)
use Illuminate\Validation\Rule; // Para reglas de validación
use Illuminate\View\View;  // Importar View

class ProductoController extends Controller
{
    /**
     * Muestra la página principal con la lista de productos (Colección).
     * Reemplaza tu lógica de 'mostrarColeccion'.
     */
    public function index(Request $request): View // <-- Inject Request
    {
        // Obtener productos filtrados usando el método helper
        $productos = $this->filterProducts($request)->get();
        // Alternativa con paginación: ->paginate(12); // Carga 12 por página

        $categorias = Categoria::orderBy('nombre')->get(); // Para el selector de filtros

        // Si la solicitud es AJAX (desde JavaScript), devolvemos solo el HTML del grid
        if ($request->ajax()) {
            // Creamos una vista parcial solo para el grid de productos
            return view('productos.partials.grid', ['productos' => $productos]);
        }

        // Si es una carga normal de página, devolvemos la vista completa
        return view('welcome', [ // O podrías crear una vista 'pages.coleccion' si prefieres
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }

    /**
     * Muestra solo los productos en oferta, filtrados.
     */
    public function ofertas(Request $request): View // <-- Inject Request
    {
        // Obtener productos filtrados, añadiendo la condición de oferta
        $productosEnOferta = $this->filterProducts($request, true)->get(); // true para solo ofertas
        // Alternativa con paginación: ->paginate(12);

        $categorias = Categoria::orderBy('nombre')->get();

        if ($request->ajax()) {
            return view('productos.partials.grid', ['productos' => $productosEnOferta]);
        }

        return view('pages.ofertas', [
            'productos' => $productosEnOferta,
            'categorias' => $categorias
        ]);
    }

    /**
     * Helper privado para construir la consulta de productos filtrados.
     * Adapta la lógica de buscarProductos
     */
    private function filterProducts(Request $request, bool $soloOfertas = false)
    {
        $query = Producto::query()->with('usuario'); // Empezamos la consulta, cargamos vendedor

        // Aplicar filtro base de solo ofertas si es necesario
        if ($soloOfertas) {
            $query->whereNotNull('precio_oferta')->where('precio_oferta', '>', 0);
        }

        // Aplicar filtros desde la Request (usa 'when' para aplicar solo si el valor existe)
        $query->when($request->filled('busqueda'), function ($q) use ($request) {
            // Usamos una búsqueda simple con LIKE por ahora (FULLTEXT requiere configuración específica)
            $term = '%' . $request->input('busqueda') . '%';
            $q->where(function($subq) use ($term) {
                $subq->where('nombre', 'LIKE', $term)
                     ->orWhere('descripcion', 'LIKE', $term);
            });
        });

        $query->when($request->filled('categoria'), function ($q) use ($request) {
            $q->where('categoria_id', $request->input('categoria'));
        });

        $query->when($request->filled('precio_min'), function ($q) use ($request) {
            $q->where('precio_final', '>=', $request->input('precio_min'));
        });

        $query->when($request->filled('precio_max'), function ($q) use ($request) {
            $q->where('precio_final', '<=', $request->input('precio_max'));
        });

        $query->when($request->filled('talla'), function ($q) use ($request) {
            $q->where('talla', $request->input('talla'));
        });

        $query->when($request->filled('estado'), function ($q) use ($request) {
            $q->where('estado', $request->input('estado'));
        });

        // Aplicar orden
        $orden = $request->input('orden', 'fecha_desc'); // Valor por defecto
        switch ($orden) {
            case 'precio_asc': $query->orderBy('precio_final', 'asc'); break;
            case 'precio_desc': $query->orderBy('precio_final', 'desc'); break;
            case 'nombre_asc': $query->orderBy('nombre', 'asc'); break;
            case 'descuento_desc': $query->orderBy('porcentaje_descuento', 'desc'); break; // Usa columna generada
            case 'fecha_desc':
            default: $query->orderBy('fecha_creacion', 'desc'); break;
        }

        return $query; // Devuelve el constructor de consultas para añadir ->get() o ->paginate()
    }

    /**
     * Muestra la página de detalles de un producto específico.
     * Reemplaza la lógica de 'mostrarProducto'
     */
    public function show(Producto $producto) // Usa Route Model Binding
    {
        // Laravel automáticamente busca el Producto por el ID de la URL.
        // Si no se encuentra, Laravel mostrará una página 404 automáticamente.

        // Pasamos el producto encontrado a la vista 'productos.show'.
        return view('productos.show', [
            'producto' => $producto
        ]);
    }

    /**
     * Muestra la lista de prendas subidas por el usuario autenticado.
     * Reemplaza mostrarMisPrendas
     */
    public function misPrendas()
    {
        $user = Auth::user();
        $prendas = Producto::where('usuario_id', $user->id)
                           ->latest('fecha_creacion') // Ordenar por más reciente
                           ->get();

        return view('productos.mis-prendas', ['prendas' => $prendas]); // Vista 'resources/views/productos/mis-prendas.blade.php'
    }

    /**
     * Muestra el formulario para editar una prenda específica del usuario.
     * Reemplaza mostrarFormEditarPrenda
     */
    public function edit(Producto $producto) // Usa Route Model Binding
    {
        // Verificar que la prenda pertenece al usuario actual
        if ($producto->usuario_id !== Auth::id()) {
            abort(403, 'No autorizado para editar esta prenda.'); // Error 403 Forbidden
        }

        $categorias = Categoria::orderBy('nombre')->get(); // Necesitamos las categorías para el select

        return view('productos.edit', [ // Vista 'resources/views/productos/edit.blade.php'
            'prenda' => $producto,
            'categorias' => $categorias
        ]);
    }

    /**
     * Actualiza una prenda específica en la base de datos.
     * Reemplaza procesarEditarPrenda
     */
    public function update(Request $request, Producto $producto)
    {
        // Verificar propiedad
        if ($producto->usuario_id !== Auth::id()) {
            abort(403);
        }

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'precio' => ['required', 'numeric', 'min:0.01'],
            'precio_oferta' => ['nullable', 'numeric', 'min:0.01', 'lt:precio'], // Precio oferta menor que precio normal
            'talla' => ['required', 'string', 'max:50'],
            'estado' => ['required', Rule::in(['Nuevo', 'Como nuevo', 'Buen estado', 'Usado'])], // Estados permitidos
            'categoria_id' => ['required', 'exists:categorias,id'], // Debe existir en la tabla categorias
        ]);
        
        // Asegurarse de que precio_oferta sea null si está vacío o es 0
        $validatedData['precio_oferta'] = !empty($validatedData['precio_oferta']) && $validatedData['precio_oferta'] > 0 ? $validatedData['precio_oferta'] : null;

        // Actualizar el producto con los datos validados
        $producto->update($validatedData);

        // Redirigir de vuelta al formulario de edición con un mensaje de éxito
        return redirect()->route('mis-prendas.edit', $producto)
                         ->with('status', '¡Prenda actualizada correctamente!'); // Mensaje flash
    }

    /**
     * Elimina una prenda específica de la base de datos.
     * Reemplaza eliminarPrenda
     */
    public function destroy(Producto $producto)
    {
        // Verificar propiedad
        if ($producto->usuario_id !== Auth::id()) {
            abort(403);
        }

        // Obtener la ruta de la imagen ANTES de borrar el registro
        $imagenPath = $producto->imagen_url;

        // Eliminar el producto de la base de datos
        $producto->delete();

        // Intentar eliminar el archivo de imagen del almacenamiento público
        if ($imagenPath) {
             $publicPath = public_path($imagenPath);
             if (file_exists($publicPath)) {
                 try {
                     unlink($publicPath);
                 } catch (\Exception $e) {
                     report($e); 
                 }
             }
        }
        
        // Redirigir a la lista de "Mis Prendas" con un mensaje de éxito
        return redirect()->route('mis-prendas.index')
                         ->with('status', '¡Prenda eliminada correctamente!');
    }

}
