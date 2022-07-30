<?php

namespace App\View\Components;

use App\Models\Menu as ModelsMenu;
use App\Models\Menurole;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Menu extends Component
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
        $user   = Auth::user();
        switch ($user->level) {
            case 'admin':
                $menu   = ModelsMenu::orderBy('urutan','ASC')->get();
                break;
                
            default:
            $dmenu      = ModelsMenu::orderBy('urutan','ASC')->get();
            $menurole   = Menurole::where('akses',$user->level)->first();
            $role       = json_decode($menurole->role);
            $menu       = [];
            foreach ($dmenu as $key) {
                $submenu = [];
                foreach ($key->menusub as $k) {
                    if (in_array($k->id,$role)) {
                        $submenu[] = $k;
                    }
                }
                if (count($submenu) > 0) {
                    $menu[] = [
                        'menu' => $key,
                        'sub' => $submenu
                    ];
                }
            }
                break;
        }
        return view('components.menu', compact('menu','user'));
    }
}
