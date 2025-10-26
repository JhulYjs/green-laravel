@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-emerald-600 bg-emerald-50 px-4 py-3 rounded-lg border border-emerald-200']) }}>
        {{ $status }}
    </div>
@endif
