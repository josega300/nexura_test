<?php

namespace App\Http\Controllers;

use App\Models\EmpleadoRole;
use Illuminate\Http\Request;

/**
 * Class EmpleadoRoleController
 * @package App\Http\Controllers
 */
class EmpleadoRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleadoRoles = EmpleadoRole::paginate();

        return view('empleado-role.index', compact('empleadoRoles'))
            ->with('i', (request()->input('page', 1) - 1) * $empleadoRoles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleadoRole = new EmpleadoRole();
        return view('empleado-role.create', compact('empleadoRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(EmpleadoRole::$rules);

        $empleadoRole = EmpleadoRole::create($request->all());

        return redirect()->route('empleado-roles.index')
            ->with('success', 'EmpleadoRole created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleadoRole = EmpleadoRole::find($id);

        return view('empleado-role.show', compact('empleadoRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleadoRole = EmpleadoRole::find($id);

        return view('empleado-role.edit', compact('empleadoRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  EmpleadoRole $empleadoRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpleadoRole $empleadoRole)
    {
        request()->validate(EmpleadoRole::$rules);

        $empleadoRole->update($request->all());

        return redirect()->route('empleado-roles.index')
            ->with('success', 'EmpleadoRole updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $empleadoRole = EmpleadoRole::find($id)->delete();

        return redirect()->route('empleado-roles.index')
            ->with('success', 'EmpleadoRole deleted successfully');
    }
}
