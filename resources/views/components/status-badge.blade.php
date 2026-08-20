@php
    $styles = [
        'active' => 'bg-green-100 text-green-700 ring-green-600/20',
        'inactive' => 'bg-gray-100 text-gray-600 ring-gray-500/20',
        'frozen' => 'bg-sky-100 text-sky-700 ring-sky-600/20',
        'cancelled' => 'bg-red-100 text-red-700 ring-red-600/20',
    ][$status] ?? 'bg-gray-100 text-gray-600 ring-gray-500/20';
@endphp

<span {{ $attributes->merge(['class' => "flex items-center gap-1.5  px-3 py-1 text-xs font-medium ring-1 ring-inset capitalize {$styles}"]) }}>
    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
    {{ $status }}
</span>
