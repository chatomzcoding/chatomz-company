<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
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
                'icon' => 'bi bi-file-earmark-spreadsheet-fill',
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
                'title' => 'Coding',
                'icon' => 'bi bi-file-earmark-spreadsheet-fill',
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
                'icon' => 'bi bi-file-earmark-spreadsheet-fill',
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
                'icon' => 'bi bi-file-earmark-spreadsheet-fill',
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
                'icon' => 'bi bi-file-earmark-spreadsheet-fill',
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
                'icon' => 'bi bi-file-earmark-spreadsheet-fill',
                'sub' => TRUE,
                'submenu' => [
                    [
                        'title' => 'Grab',
                        'link' => 'demo/grab',
                    ],
                ]
            ],
        ];
        return view('components.sidebar', compact('menu'));
    }
}
