<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $head;
    public $p;
    public $active;
    public $hyperlink;

    public function __construct($head="judul header",$p=null,$active="halaman",$hyperlink=NULL)
    {
        $this->head = $head;
        $this->p = $p;
        $this->active = $active;
        $this->hyperlink = $hyperlink;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header');
    }
}
