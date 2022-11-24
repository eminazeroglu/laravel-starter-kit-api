@props([
    'property' => 'primary',
    'leftIcon' => '',
    'rightIcon' => '',
    'type' => 'button'
])
<button {{ $attributes->merge(['class' => 'btn btn--' . $property]) }} type="{{ $type }}">
    @if($leftIcon)
        <i class="icon {{ $leftIcon }}"></i>
    @endif
    <span>{{ $slot }}</span>
    @if($rightIcon)
        <i class="icon {{ $rightIcon }}"></i>
    @endif
</button>
