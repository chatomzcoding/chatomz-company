<?php

namespace App\View\Components\Dashboard;

use App\Models\Jurnal;
use Illuminate\View\Component;

class Infojurnal extends Component
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
        $data   = Jurnal::whereDate('tanggal',tgl_sekarang())->limit(5)->latest()->get();
        return view('components.dashboard.infojurnal', compact('data'));
    }
}
