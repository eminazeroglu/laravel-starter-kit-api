@props([
    'href' => '',
    'box' => false
])
@if($box)
<div {{ $attributes->merge(['class' => 'block py-2 px-4']) }}>
    {{ $slot }}
</div>
@else
    <li>
        <a href="{{ $href }}" {{ $attributes->merge(['class' => 'block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white']) }}>{{ $slot }}</a>
    </li>
@endif

