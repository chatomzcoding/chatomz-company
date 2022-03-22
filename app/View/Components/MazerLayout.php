<?php

namespace App\View\Components;

use App\Models\Infowebsite;
use Illuminate\View\Component;

class MazerLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;

    public function __construct($title='Admin')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $info   = Infowebsite::first();
        return view('layouts.mazer', compact('info'));
    }
}
