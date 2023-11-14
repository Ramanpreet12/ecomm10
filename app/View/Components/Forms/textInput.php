<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class textInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $label;
    public $type;
    public $name;
    public $placeholder;
    public function __construct($label ,  $type , $name ,$placeholder )
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.text-input');
    }
}
