<?php

namespace App\View\Components\Common;

use Illuminate\View\Component;

class Header extends Component
{

    public function __construct()
    {
        //
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.common.header');
    }
}
