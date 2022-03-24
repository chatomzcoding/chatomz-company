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
    public $id;

    public function __construct($judul,$link,$id="tambah")
    {
        $this->link = $link;
        $this->judul = $judul;
        $this->id = $id;
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
