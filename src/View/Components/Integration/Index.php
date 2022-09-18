<?php

namespace Pipedrive\View\Components\Integration;

use Illuminate\View\Component;

class Index extends Component
{
    public string $image;
    public string $title;
    public string $description;
    public string $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $image, string $title, string $description, ?string $route = null)
    {
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
        $this->route = $route ? route($route) : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('pipedrive::components.integration.index');
    }
}
