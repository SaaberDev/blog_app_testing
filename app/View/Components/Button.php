<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        public ?string $href = null,
        public string $color = 'green',
        public string $textColor = 'white',
    )
    {
        //
    }

    public function render()
    {
        if ($this->href) {
            return view('components.button-link');
        }

        return view('components.button-button');
    }
}
