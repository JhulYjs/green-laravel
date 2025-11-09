@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-3 border-l-4 border-emerald-400 text-start text-base font-bold text-emerald-700 bg-gradient-to-r from-emerald-50 to-teal-50 focus:outline-none focus:text-emerald-800 focus:bg-emerald-100 focus:border-emerald-600 transition-all duration-300 ease-in-out rounded-r-lg'
            : 'block w-full ps-4 pe-4 py-3 border-l-4 border-transparent text-start text-base font-medium text-gray-700 hover:text-emerald-600 hover:bg-gradient-to-r hover:from-gray-50 hover:to-emerald-50 hover:border-emerald-300 focus:outline-none focus:text-emerald-700 focus:bg-emerald-50 focus:border-emerald-400 transition-all duration-300 ease-in-out rounded-r-lg';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
<!-- Cambio de estilos por Joha -->
