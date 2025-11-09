<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - GreenCloset</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="text-center">
        <!-- Icono -->
        <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <span class="text-white text-4xl">👋</span>
        </div>
        
        <!-- Mensaje -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">
            ¡Bienvenido a GreenCloset!
        </h1>
        
        <p class="text-gray-600 text-lg mb-8">
            Tu tienda de moda sostenible
        </p>
        
        <!-- Botón CORREGIDO -->
        <a href="{{ route('coleccion') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-colors inline-block">
            Comenzar a explorar
        </a>

        <!-- Enlaces adicionales -->
        <div class="mt-6 space-x-4">
            <a href="{{ route('ofertas') }}" class="text-green-600 hover:text-green-800 text-sm">Ver ofertas</a>
            <a href="{{ route('soporte.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">Ayuda</a>
        </div>
    </div>
</body>
</html>
<!-- Cambio de estilos por Joha -->
