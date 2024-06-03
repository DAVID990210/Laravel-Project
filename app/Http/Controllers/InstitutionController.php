<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInstitutionRequest;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Resources\InstitutionResource;
use App\Http\Resources\RoleResource;
use App\Models\Institution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Institutions/InstitutionIndex', [
            'institutions' => InstitutionResource::collection(Institution::all()),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Institutions/Create', [
            'roles' => RoleResource::collection(Role::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateInstitutionRequest $request)
    {
        $institution = Institution::create([
            'name' => $request->name,
            'code' => $request->code,
            'address' => $request->address,
        ]);
        if($request->has('roles')) {
            $institution->syncRoles($request->input('roles.*.name'));
        }
        return to_route('institutions.index')->with('success', 'Institución creada Exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Institution $institution): Response
    {
        $institution = Institution::findOrFail($institution->id);
        $institution->load('roles');

        return Inertia::render('Admin/Institutions/Edit', [
            'institution' => new InstitutionResource($institution),
            'roles' => RoleResource::collection(Role::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRoleRequest $request, string $id)
    {
        $institution = Institution::findOrFail($id);

        $institution->update([
            'name' => $request->name,
            'adress' => $request->address,
        ]);
        return to_route('institutions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $institution = Institution::findOrFail($id);
        $institution->delete();
        return to_route('institutions.index');
    }
}
