@props(['status'])

@php
    $normalized = strtolower(trim($status ?? ''));

    $isActive = in_array($normalized, ['aktif', 'a', 'active']);

    $classes = $isActive
        ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20'
        : 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/20';
@endphp

<span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium {{ $classes }}">
    <span class="h-1.5 w-1.5 rounded-full {{ $isActive ? 'bg-emerald-600' : 'bg-red-600' }}"></span>
    {{ $status }}
</span>