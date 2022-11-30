@props([
    'value' => ''
])
<div class="w-full form-group">
    <textarea
            {{ $attributes->merge(['class' => 'form-element']) }}
    >{{ $value }}</textarea>
</div>
