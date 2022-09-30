@props([
    'bgPhoto' => '',
    'title' => '',
    'nav' => []
])
<section
        style="background-image: url({{ asset('assets/img/bg/page-title.jpg') }})"
        class="breadcrumb mb-10"
>
    <x-ui.container class="breadcrumb-content">
        <div class="breadcrumb-inner">
            @isset($title)
                <h1 class="breadcrumb-title">{{ $title }}</h1>
            @endisset
            @if(count($nav))
                <ul class="breadcrumb-nav">
                    @foreach($nav as $item)
                        <li>
                            @if(isset($item['link']))
                                <a href="{{ $item['link'] }}">{{ $item['name'] }}</a>
                                <i class="icon-arrow-right"></i>
                            @else
                                <span>{{ $item['name'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </x-ui.container>
</section>
