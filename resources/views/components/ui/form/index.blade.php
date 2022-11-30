@props(['action' => null, 'ajax' => null, 'method' => null])
<form
        @if($action && !$ajax)
            action="{{ $action }}"
        @endif
        @if($method && !$ajax)
            method="{{ $method }}"
        @endif
        @if($ajax)
            data-content="form"
            data-url="{{ $ajax }}"
        @endif
        {{ $attributes->merge(['class' => 'w-full']) }}
>
    {{ $slot ?? '' }}
</form>
