<?php

namespace App\Helpers;

class Breadcrumbs
{
    public static function generate($routeName, $params = [])
    {
        $breadcrumbs = [
            'home' => [
                'title' => 'Home',
                'crumbs' => [
                    ['name' => 'Home', 'url' => route('home')],
                ]
            ],
            'projects.index' => [
                'title' => 'Projects',
                'crumbs' => [
                    ['name' => 'Home', 'url' => route('home')],
                    ['name' => 'Projects', 'url' => route('projects.index')],
                ]
            ],
            'projects.create' => [
                'title' => 'Create Project',
                'crumbs' => [
                    ['name' => 'Home', 'url' => route('home')],
                    ['name' => 'Projects', 'url' => route('projects.index')],
                    ['name' => 'Create', 'url' => route('projects.create')],
                ]
            ],
            'connections.index' => [
                'title' => 'Connections',
                'crumbs' => [
                    ['name' => 'Home', 'url' => route('home')],
                    ['name' => 'Connections', 'url' => route('connections.index')],
                ]
            ],
        ];

        return $breadcrumbs[$routeName] ?? [];
    }
}
