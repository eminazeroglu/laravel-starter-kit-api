@props([
    'property' => 'primary',
    'leftIcon' => '',
    'rightIcon' => '',
    'type' => 'button',
    'href' => '',
    'center' => false,
    'block' => false,
    'rounded' => false
])

@if($href)
    <a {{ $attributes->merge(['class' => 'btn btn--' . $property . ($center ? ' justify-center' : '') . ($block ? ' w-full' : '') . ($rounded ? ' btn--rounded' : '')]) }} href="{{ $href }}">
        @if($leftIcon)
            <i class="icon {{ $leftIcon }}"></i>
        @endif
        <span>{{ $slot }}</span>
        @if($rightIcon)
            <i class="icon {{ $rightIcon }}"></i>
        @endif
    </a>
@else
    <button {{ $attributes->merge(['class' => 'btn btn--' . $property . ($center ? ' justify-center' : '') . ($block ? ' w-full' : '') . ($rounded ? ' btn--rounded' : '')]) }} type="{{ $type }}">
        @if($leftIcon)
            <i class="icon {{ $leftIcon }}"></i>
        @endif
        <span>{{ $slot }}</span>
        @if($rightIcon)
            <i class="icon {{ $rightIcon }}"></i>
        @endif
    </button>
@endif

