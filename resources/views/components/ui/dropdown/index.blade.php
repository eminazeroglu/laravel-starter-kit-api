@props([
    'id' => 'dropdown',
    'default' => '',
    'dropdownClass' => '',
    'dropdownOpen' => true,
    'hasItem' => true,
    'buttonClass' => ''
])
<button @if($dropdownOpen) data-dropdown-toggle="{{ $id }}" @endif class="dropdown-button {{ $buttonClass ?? '' }}" type="button">
    <span>{{ $default }}</span>
    @if($dropdownOpen)
        <i class="icon-chevron-down"></i>
    @endif
</button>
@if($dropdownOpen)
    @if($hasItem)
        <div id="{{ $id }}" {{ $attributes->merge(['class' => 'dropdown-body ' . $dropdownClass]) }}>
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                {{ $slot }}
            </ul>
        </div>
    @else
        <div id="{{ $id }}" {{ $attributes->merge(['class' => 'dropdown-body ' . $dropdownClass]) }}>
            {{ $slot }}
        </div>
    @endif
@endif
