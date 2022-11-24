@props([
    'label' => '',
    'value' => '',
    'checked' => false
])
<div class="inline-flex items-center">
    <label class="text-sm whitespace-nowrap flex items-center space-x-1 font-medium text-gray-900 dark:text-gray-300">
        <input type="checkbox" {{ $attributes->merge(['class' => 'w-4 h-4 text-primary bg-white rounded border-gray-300']) }} value="{{ $value }}" @if($checked) checked @endif>
        <span>{{ $label }}</span>
    </label>
</div>
