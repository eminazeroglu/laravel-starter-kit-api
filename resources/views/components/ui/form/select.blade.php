@props([
    'options' => [],
    'placeholder' => '',
    'displayExpr' => 'name',
    'valueExpr' => 'id',
    'value' => '',
    'select2' => false
])
<select {{ $attributes->merge(['class' => 'form-element' . ($select2 ? ' select2' : '')]) }}
        @if($select2 && $placeholder)
            data-placeholder="{{ $placeholder }}"
        @endif
>
    @if($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif
    @foreach($options as $option)
        <option
                value="{{ $option[$valueExpr] }}"
                @if($value === $option[$valueExpr]) selected @endif
        >{{ $option[$displayExpr] }}</option>
    @endforeach
</select>

@if($select2)
    @pushonce('inlineCss')
        <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    @endpushonce

    @pushonce('inlineJs')
        <script src="{{ asset('assets/js/select2.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('.select2').select2();
            });
        </script>
    @endpushonce
@endif
