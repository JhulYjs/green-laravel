@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm transition-all duration-300 ease-in-out px-4 py-3 border-2 focus:ring-2 focus:ring-opacity-20 focus:ring-emerald-200 hover:border-gray-400']) }}>
