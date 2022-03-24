<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modalubah extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $judul;
    public $link;
    public $id;

    public function __construct($judul="ubah data",$link='',$id="ubah")
    {
        $this->judul = $judul;
        $this->link = $link;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modalubah');
    }
}
