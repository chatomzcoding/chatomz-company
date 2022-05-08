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
    public $size;
    public $tabindex;

    public function __construct($judul="ubah data",$link='',$id="ubah",$size="",$tabindex="-1")
    {
        $this->judul = $judul;
        $this->link = $link;
        $this->id = $id;
        $this->size = $size;
        $this->tabindex = $tabindex;
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
