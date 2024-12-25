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
            'projects.create' => [
                'title' => 'Create Project',
                'crumbs' => [
                    ['name' => 'Home', 'url' => route('home')],
                    ['name' => 'Projects', 'url' => route('projects.index')],
                    ['name' => 'Create', 'url' => route('projects.create')],
                ]
            ],

        ];

        return $breadcrumbs[$routeName] ?? [];
    }
}