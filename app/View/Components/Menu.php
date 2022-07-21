<?php

namespace App\View\Components;

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
                        'title' => 'Big Data',
                        'icon' => 'bi bi-award',
                        'sub' => TRUE,
                        'submenu' => [
                            [
                                'title' => 'Bot',
                                'link' => 'chatomzbot',
                            ],
                            [
                                'title' => 'Unsil',
                                'link' => 'unsil',
                            ],
                            [
                                'title' => 'Informasi',
                                'link' => 'informasi',
                            ],
                            [
                                'title' => 'Tempat',
                                'link' => 'tempat',
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
                            ],
                            [
                                'title' => 'Usaha',
                                'link' => 'usaha',
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
                            ],
                            [
                                'title' => 'Keuangan',
                                'link' => 'rekening',
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
                            ],
                            [
                                'title' => 'Item',
                                'link' => 'item',
                            ],
                            [
                                'title' => 'Backup DB',
                                'link' => 'backupdb',
                            ]
                        ]
                    ]
                ];
                break;
            
            default:
            $menu   = [
                [
                    'sub' => FALSE,
                    'icon' => 'bi-person',
                    'title' => 'Orang',
                    'link' => 'orang',
                ],
                [
                    'sub' => FALSE,
                    'icon' => 'bi-people',
                    'title' => 'Keluarga',
                    'link' => 'keluarga',
                ]
            ];
                break;
        }
        return view('components.menu', compact('menu'));
    }
}
