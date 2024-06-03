<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:institutions',
            'address' => 'required|string|max:255',
        ]);
        $institution = Institution::create([
            'name' => $request->name,
            'code' => $request->code,
            'address' => $request->address,
        ]);
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
    public function update(Request $request, Institution $institution): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $institution->update([
            'name' => $request->name,
            'adress' => $request->address,
        ]);
        return to_route('institutions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institution $institution): RedirectResponse
    {
        $institution->delete();
        return to_route('institutions.index');
    }
}
