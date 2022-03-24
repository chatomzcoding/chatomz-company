<?php

namespace App\View\Components;

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
        $menu   = [
            [
                'title' => 'Kingdomz',
                'icon' => 'bi bi-building',
                'sub' => TRUE,
                'submenu' => [
                    [
                        'title' => 'Orang',
                        'link' => 'orang',
                    ],
                    [
                        'title' => 'Keluarga',
                        'link' => 'keluarga',
                    ],
                    [
                        'title' => 'Grup',
                        'link' => 'grup',
                    ],
                    [
                        'title' => 'Jejak',
                        'link' => 'jejak',
                    ]
                ]
            ],
            [
                'title' => 'Karya',
                'icon' => 'bi bi-award',
                'sub' => TRUE,
                'submenu' => [
                    [
                        'title' => 'Bot',
                        'link' => 'chatomzbot',
                    ]
                ]
            ],
            [
                'title' => 'Bisnis',
                'icon' => 'bi bi-shop',
                'sub' => TRUE,
                'submenu' => [
                    [
                        'title' => 'Wadec',
                        'link' => 'wadec',
                    ]
                ]
            ],
            [
                'title' => 'Asset',
                'icon' => 'bi bi-tv',
                'sub' => TRUE,
                'submenu' => [
                    [
                        'title' => 'Barang',
                        'link' => 'barang',
                    ]
                ]
            ],
            [
                'title' => 'Admin',
                'icon' => 'bi bi-person-square',
                'sub' => TRUE,
                'submenu' => [
                    [
                        'title' => 'Info Website',
                        'link' => 'info-website',
                    ],
                    [
                        'title' => 'User',
                        'link' => 'user',
                    ],
                    [
                        'title' => 'Kategori',
                        'link' => 'kategori',
                    ]
                ]
            ],
            [
                'title' => 'Demo',
                'icon' => 'bi bi-app-indicator',
                'sub' => TRUE,
                'submenu' => [
                    [
                        'title' => 'Grab',
                        'link' => 'demo/grab',
                    ],
                    [
                        'title' => 'Unsil',
                        'link' => 'unsil',
                    ],
                ]
            ],
        ];
        return view('components.menu', compact('menu'));
    }
}
