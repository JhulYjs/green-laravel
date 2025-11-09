<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 border border-gray-300 rounded-xl font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:from-gray-200 hover:to-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 disabled:opacity-25 transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg']) }}>
    {{ $slot }}
</button>
<!-- Cambio de estilos por Joha -->
