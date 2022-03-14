<?php

namespace App\View\Components\Chatomz;

use App\Models\Orang;
use Illuminate\View\Component;

class Profil extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $profil     = Orang::find(1);
        return view('components.chatomz.profil', compact('profil'));
    }
}
