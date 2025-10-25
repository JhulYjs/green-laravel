@props(['status'])

@if ($status)
<<<<<<< HEAD
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-emerald-600 bg-emerald-50 px-4 py-3 rounded-lg border border-emerald-200']) }}>
=======
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
        {{ $status }}
    </div>
@endif
