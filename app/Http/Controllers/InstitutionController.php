<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInstitutionRequest;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Resources\InstitutionResource;
use App\Http\Resources\RoleResource;
use App\Models\Institution;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Institutions/InstitutionIndex', [
            'institutions' => InstitutionResource::collection(Institution::all()),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Institutions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateInstitutionRequest $request): RedirectResponse
    {
        Institution::create($request->validated());
        return to_route('institutions.index')->with('success', 'Institución creada Exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Institution $institution): Response
    {
        return Inertia::render('Admin/Institutions/Edit', [
            'institution' => new InstitutionResource($institution),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateInstitutionRequest $request, Institution $institution): RedirectResponse
    {
        $institution->update($request->validated());

        return to_route('institutions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institution $institution)
    {
        $institution->delete();
        return to_route('institutions.index');
    }
}
