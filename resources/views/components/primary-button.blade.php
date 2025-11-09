<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-wider hover:from-emerald-600 hover:to-teal-600 focus:from-emerald-700 focus:to-teal-700 active:from-emerald-800 active:to-teal-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none']) }}>
    {{ $slot }}
</button>
<!-- Cambio de estilos por Joha -->
