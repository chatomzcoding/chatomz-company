<?php

namespace App\View\Components\Sistem;

use Illuminate\View\Component;

class Tambah extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $url;
    public $id;

    public function __construct($url='#',$id='tambah')
    {
        $this->url = $url;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sistem.tambah');
    }
}
