<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tombolstatistik extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $teks;
    public $s;
    public $ds;
    public function __construct($teks='klik disini',$s,$ds)
    {
        $this->teks = $teks;
        $this->ds = $ds;
        $this->s = $s;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tombolstatistik');
    }
}
