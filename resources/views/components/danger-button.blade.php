<<<<<<< HEAD
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-gradient-to-r from-rose-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-wider hover:from-rose-700 hover:to-pink-700 active:from-rose-800 active:to-pink-800 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl']) }}>
=======
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
    {{ $slot }}
</button>
