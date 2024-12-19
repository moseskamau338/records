<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterTenantRequest;
use App\Models\Tenant;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class RegisteredTenantController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterTenantRequest $request): RedirectResponse
    {
       $tenant = Tenant::create($request->validated());
       $tenant->createDomain(["domain" => $request->domain]);
       $protocol = request()->secure() ? 'https://' : 'http://';
       $loginUrl = $protocol . $tenant->domain . '/login';
       return redirect()->to($loginUrl);
    }
}
