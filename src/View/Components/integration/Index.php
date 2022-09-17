<?php

namespace Pipedrive\View\Components\integration;

use Illuminate\View\Component;

class Index extends Component
{
    public $image;
    public $title;
    public $description;
    public $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($image, $title, $description, $route)
    {
            $this->image = $image;
            $this->title = $title;
            $this->description = $description;
            $this->route = $route ? route($route) : '';    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.integration.index');
    }
}
