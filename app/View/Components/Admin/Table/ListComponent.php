<?php

namespace App\View\Components\Admin\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $cms;
    public $pagesmodule;
//
    public function __construct($cms , $pagesmodule)
    {
        $this->cms = $cms;
        $this->pagesmodule = $pagesmodule;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.table.list-component');
    }
}
