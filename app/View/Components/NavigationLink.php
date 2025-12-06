<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavigationLink extends Component
{
    public $href;
    public $icon;
    public $icon2;
    public $active;
    public $topliclass;

    /**
     * Create a new component instance.
     *
     * @param string $href
     * @param string $icon
     */
    public function __construct($href, $icon, $icon2, $topliclass)
    {
        $this->href = $href;
        $this->topliclass = $topliclass;
        $this->icon = $icon;
        $this->icon2 = $icon2 ?? '';
        
        // Determine active state - check if current URL matches or starts with the href
        $currentUrl = request()->url();
        $this->active = $currentUrl === $href || str_starts_with($currentUrl, $href . '/');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.navigation-link');
    }
}
