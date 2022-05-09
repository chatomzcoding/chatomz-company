<?php

namespace App\View\Components;

use App\Models\Infowebsite;
use App\Models\Orang;
use App\Models\Rekening;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class MazerLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $datatables;
    public $alert;
    public $select;

    public function __construct($title='Admin',$datatables=FALSE,$alert=FALSE,$select=FALSE)
    {
        $this->title = $title;
        $this->datatables = $datatables;
        $this->alert = $alert;
        $this->select = $select;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $info   = Infowebsite::first();
        $user   = Auth::user();
        $rekening = Rekening::where('jenis','cash')->pluck('nama_rekening','id');
        $profil     = Orang::find(1);
        return view('layouts.mazer', compact('info','user','rekening','profil'));
    }
}
