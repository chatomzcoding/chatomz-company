<?php

namespace App\View\Components;

use Illuminate\View\Component;

class taborang extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $orang;
    public $id;
    public $tab;
    public $photo;
    public $konten;
    public $showchart;

    public function __construct($orang,$id,$tab,$photo='aktif',$konten=null,$showchart=null)
    {
        $this->orang = $orang;
        $this->id = $id;
        $this->tab = $tab;
        $this->photo = $photo;
        $this->konten = $konten;
        $this->showchart = $showchart;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.taborang');
    }
}
