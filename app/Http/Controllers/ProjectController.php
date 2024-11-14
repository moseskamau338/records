<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Projects/Index');
    }

     public function view(string $id): Response
    {
        return Inertia::render('Projects/View', ['id' => $id]);
    }
     public function flow(string $id): Response
    {
        return Inertia::render('Projects/Flow', ['id' => $id]);
    }
     public function stories(string $id): Response
    {
        return Inertia::render('Projects/ReconStories', ['id' => $id]);
    }

}
