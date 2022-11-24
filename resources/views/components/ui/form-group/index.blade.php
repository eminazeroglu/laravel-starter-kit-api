@props([
    'for' => '',
    'label' => '',
])
<div class="w-full">
    @if($label)
        <label for="{{ $for }}" class="form-label">{{ $label }}</label>
    @endif
    {{ $slot }}
</div>
