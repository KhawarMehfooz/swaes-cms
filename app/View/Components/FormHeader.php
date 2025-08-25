<?php

namespace App\View\Components;

use App\Settings\GeneralSettings;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormHeader extends Component
{
    public $generalSettings;
    /**
     * Create a new component instance.
     */
    public function __construct(GeneralSettings $generalSettings)
    {
        $this->generalSettings = $generalSettings;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-header');
    }
}
