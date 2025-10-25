{{-- 1. Indica que esta vista extiende el layout admin --}}
@extends('layouts.admin') 

{{-- 2. Define el título que pasaremos al layout --}}
@section('title', 'Dashboard Principal') {{-- Cambiado de 'title' a @section('title', ...) si tu layout usa @yield('title') --}}
{{-- O si tu layout usa $title directamente --}}
{{-- @php $title = 'Dashboard Principal'; @endphp --}}

{{-- Opcional: Definir el slot 'header' si tu layout lo espera --}}
{{-- @section('header')
    Resumen General
@endsection --}}

{{-- 3. Define la sección principal de contenido --}}
@section('content') {{-- Asumiendo que tu layout tiene @yield('content') en lugar de {{ $slot }} --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="md:col-span-3 bg-white p-6 rounded-lg border border-brand-100 shadow-sm">
            <h2 class="text-2xl font-semibold text-brand-800 font-serif">¡Bienvenido al Panel de Control!</h2>
            <p class="text-brand-600 mt-1">Desde aquí podrás gestionar los usuarios, productos y pedidos de GreenCloset.</p>
        </div>

        {{-- Tarjeta Total Usuarios --}}
        <div class="bg-white p-6 rounded-lg border border-brand-100 shadow-sm">
            <h3 class="text-lg font-semibold text-brand-700">Total Usuarios</h3>
            <p class="text-3xl font-bold text-brand-900 mt-2">{{ $total_usuarios }}</p>
        </div>

        {{-- Tarjeta Total Productos --}}
        <div class="bg-white p-6 rounded-lg border border-brand-100 shadow-sm">
            <h3 class="text-lg font-semibold text-brand-700">Total Productos</h3>
            <p class="text-3xl font-bold text-brand-900 mt-2">{{ $total_productos }}</p>
        </div>

        {{-- Tarjeta Ventas Totales --}}
        <div class="bg-white p-6 rounded-lg border border-brand-100 shadow-sm">
            <h3 class="text-lg font-semibold text-brand-700">Ventas Totales</h3>
            <p class="text-3xl font-bold text-brand-900 mt-2">${{ number_format($total_ventas, 2) }}</p>
        </div>

    </div>
@endsection {{-- Cierra la sección de contenido --}}