@props(['value'])

<<<<<<< HEAD
<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-gray-700 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
=======
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
