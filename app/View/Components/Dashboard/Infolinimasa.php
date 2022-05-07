<?php

namespace App\View\Components\Dashboard;

use App\Models\Linimasa;
use Illuminate\View\Component;

class Infolinimasa extends Component
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
        $data   = Linimasa::where('tanggal','>=',tgl_sekarang())->orderBy('tanggal','asc')->get();
        return view('components.dashboard.infolinimasa', compact('data'));
    }
}
