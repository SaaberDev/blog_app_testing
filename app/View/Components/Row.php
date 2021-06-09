<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Row extends Component
{
    public function __construct(
        public int $cols = 6,
        public bool $header = false,
        public string $color = 'white',
    ) {
    }

    public function render()
    {
        return view('components.row');
    }
}
