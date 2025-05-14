<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component
{
    public string $route;
    public string $placeholder;

    public function __construct(string $route, string $placeholder)
    {
        $this->route = $route;
        $this->placeholder = $placeholder;
    }

    public function render(): View|Closure|string
    {
        return view('components.search');
    }
}
