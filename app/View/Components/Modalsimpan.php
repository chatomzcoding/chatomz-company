<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modalsimpan extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $judul;
    public $link;

    public function __construct($judul,$link)
    {
        $this->link = $link;
        $this->judul = $judul;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modalsimpan');
    }
}
