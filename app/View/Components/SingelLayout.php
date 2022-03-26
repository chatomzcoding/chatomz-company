<?php

namespace App\View\Components;

use App\Models\Infowebsite;
use Illuminate\View\Component;

class SingelLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $back;

    public function __construct($back='dashboard')
    {
        $this->back = $back;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $info   = Infowebsite::first();
        return view('layouts.single', compact('info'));
    }
}
