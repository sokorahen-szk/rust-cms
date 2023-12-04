<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * @param string|null $url
     * @param string|null $text
     * @param string|null $color
     */
    public function __construct(
        public ?string $url,
        public ?string $text,
        public ?string $color
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-around');
    }
}
