<?php

namespace App\View\Components\Sistem;

use Illuminate\View\Component;

class Hapus extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $url;

    public function __construct($id,$url)
    {
        $this->id = $id;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sistem.hapus');
    }
}
