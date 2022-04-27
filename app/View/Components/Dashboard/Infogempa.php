<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Infogempa extends Component
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
        $data = datajson('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json');
        return view('components.dashboard.infogempa', compact('data'));
    }
}
