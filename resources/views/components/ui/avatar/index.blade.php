@props([
    'size' => '2.5',
    'circle' => false,
    'border' => false,
    'src' => '',
    'alt' => '',
    'nick' => '',
    'tooltip' => '',
    'status' => '',
])
@php
    $randId = 'avatar' . str()->random(30);
@endphp
<div class="inline-flex relative items-center">
    @if($src)
        <img
                src="{{ $src }}"
                alt="{{ $alt }}"
                style="width: {{ $size }}rem; height: {{ $size }}rem"
                @if($tooltip)
                    data-tooltip-target="{{ $randId }}"
                @endif
                @class([
                   'rounded' => !$circle,
                   'rounded-full' => $circle,
                   'p-0.5 ring-2 ring-gray-300' => $border
                ])
        >
    @elseif($nick)
        <div
                @if($tooltip)
                    data-tooltip-target="{{ $randId }}"
                @endif
                @class([
                    'inline-flex overflow-hidden relative text-sm justify-center items-center bg-gray-100 dark:bg-gray-600',
                    'rounded' => !$circle,
                    'rounded-full' => $circle,
                    'p-0.5 ring-2 ring-gray-300' => $border
                ])
                style="width: {{ $size }}rem; height: {{ $size }}rem"
        >
            <span class="font-bold text-gray-600 dark:text-gray-300">{{ $nick }}</span>
        </div>
    @else
        <div
                @if($tooltip)
                    data-tooltip-target="{{ $randId }}"
                @endif
                style="width: {{ $size }}rem; height: {{ $size }}rem"
                @class([
                        'overflow-hidden relative bg-gray-100',
                        'rounded' => !$circle,
                        'rounded-full' => $circle,
                        'p-0.5 ring-2 ring-gray-300' => $border
                ])
        >
            <svg
                    style="width: {{ $size+0.5 }}rem; height: {{ $size+0.5 }}rem"
                    class="absolute text-gray-400 -left-1"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
            >
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
        </div>
    @endif

    @if($tooltip)
        <div id="{{$randId}}" role="tooltip" data-tooltip-placement="bottom" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
            {{ $tooltip }}
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    @endif

    @if($status)
        <span
            @class([
                'top-0 left-7 absolute  w-3.5 h-3.5 border-2 border-white dark:border-gray-800 rounded-full',
                'bg-green-400' => $status === 'online',
                'bg-red-400' => $status === 'offline',
            ])
        ></span>
    @endif
</div>
