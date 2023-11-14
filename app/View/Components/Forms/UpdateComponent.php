<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $label , $type , $name , $placeholder , $value;

    public function __construct($label ,  $type , $name ,$placeholder , $value)
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.update-component');
    }
}
