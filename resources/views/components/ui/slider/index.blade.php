@props([
    'sliderId' => '',
    'class' => '',
    'options' => [],
    'buttonNextClass' => '',
    'buttonPrevClass' => '',
])
<div class="swiper {{ $class }}" id="{{ $sliderId }}">
    <div class="swiper-wrapper">
        {{ $slot }}
    </div>
    <div class="swiper-pagination">
        @if(isset($options['pagination']['type']['fraction']))
            <div class="swiper-page-bar"></div>
        @endif
    </div>
    <div class="swiper-button-next {{ $buttonNextClass }}"></div>
    <div class="swiper-button-prev {{ $buttonPrevClass }}"></div>
</div>

@pushonce('inlineCss')
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}">
@endpushonce

@pushonce('inlineJs')
    <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
@endpushonce

@push('inlineJs')
    <script>
        var swiper = new Swiper(`#{{$sliderId}}`, @json($options));

        @if(isset($options['autoplay']))
            $("#{{$sliderId}}").hover(function() {
                (this).swiper.autoplay.stop();
            }, function() {
                (this).swiper.autoplay.start();
            });
        @endif
    </script>
@endpush
