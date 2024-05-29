<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Home extends Component
{
    public $popularMovies;

    /**
     * Create a new component instance.
     */
    public function __construct($popularMovies)
    {
        $this->popularMovies = $popularMovies;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home');
    }
}
