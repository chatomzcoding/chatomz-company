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
    public $title;

    public function __construct($back='dashboard',$title='Chatomz Company')
    {
        $this->back = $back;
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
        return view('layouts.single', compact('info'));
    }
}
