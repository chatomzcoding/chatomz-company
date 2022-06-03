<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Aksi extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $link;
    public $detail;

    public function __construct($id,$link='',$detail='FALSE')
    {
        $this->id = $id;
        $this->link = $link;
        $this->detail = $detail;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.aksi');
    }
}
