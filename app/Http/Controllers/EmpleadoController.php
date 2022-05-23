<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Area;
use App\Models\Role;
use App\Models\EmpleadoRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Class EmpleadoController
 * @package App\Http\Controllers
 */
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::paginate();

        return view('empleado.index', compact('empleados'))
            ->with('i', (request()->input('page', 1) - 1) * $empleados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleado = new Empleado();
        $areas = Area::pluck('nombre','id');
        $roles = Role::all();
        return view('empleado.create', compact('empleado', 'areas','roles'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $request->validate([
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|string|email|unique:empleados|max:255',
            'area_id' => 'required',
            'descripcion' => 'required',
        ]);
        
        request()->validate(Empleado::$rules);

        $boletin = 0;
        
        if($request->boletin == "on") 
            $boletin = 1;

        $empleado = new Empleado();
        $empleado->nombre = $request->nombre;
        $empleado->email = $request->email;
        $empleado->sexo = $request->sexo;
        $empleado->area_id = $request->area_id;
        $empleado->boletin = $boletin;
        $empleado->descripcion = $request->descripcion;
        $empleado->save();

        $data = Empleado::latest('id')->first();
        //este valor se asocia a la tabla de roles por empleados
        $idEmpleado = $data['id'];
        
        //Recorrer el arreglo de roles 
        for ($i=0; $i < count($request->roles); $i++) { 
            //crear objeto empleado rol
            $empleadoRol = new EmpleadoRole();
            $empleadoRol->empleado_id = $empleado->id;
            $empleadoRol->rol_id = $request->roles[$i];
            $empleadoRol->save();
        }


        return redirect()->route('empleados.index')
            ->with('success', 'Empleado creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);
        $arrayRoles = array();

        $roles = DB::table('roles')
        ->select('nombre', 'nombre as rol')
        ->get();

        $rolesEmp = DB::table('empleado_roles')->where('empleado_id', $empleado->id)->get();

        for ($i=0; $i < count($rolesEmp); $i++) { 
            $arrayRoles[$i] = $roles[$i]->rol;
        }
        
        //crear mensaje de no existen asociados.
        $texto = '';
        if (count($rolesEmp) == 0 )
            $texto = 'No existen registros asociados.';

        return view('empleado.show', compact('empleado', 'texto'),  ['roles' => $arrayRoles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        $areas = Area::pluck('nombre','id');
        $roles = Role::all();

        $arrayRoles = array();


        $rolesEmp = DB::table('empleado_roles')->where('empleado_id', $empleado->id)->get();

        if($empleado->boletin == 0){
            $checkBoletin = false;
            $bolValue = 'no';
        }

        if($empleado->boletin == 1){
            $checkBoletin = true;
            $bolValue = 'yes';
        }

        return view('empleado.edit', compact('empleado', 'areas','roles','rolesEmp','checkBoletin','bolValue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {

        $rules = $request->validate([
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|string|email|max:255',
            'area_id' => 'required',
            'descripcion' => 'required',
        ]);

        request()->validate(Empleado::$rules);

        if($request->boletin != null){
            $boletin = 1;
        }else{
            $boletin = 0;
        }

        $rolesEmp = DB::table('empleado_roles')->where('empleado_id', $empleado->id)->get();
        
        //borrar arreglo de empleados y roles
        DB::table('empleado_roles')->where('empleado_id', $empleado->id)->delete();

        $empleado->nombre = $request->nombre;
        $empleado->email = $request->email;
        $empleado->sexo = $request->sexo;
        $empleado->area_id = $request->area_id;
        $empleado->boletin = $boletin;
        $empleado->descripcion = $request->descripcion;
        $empleado->save();


        //Recorrer el arreglo de roles si existe
        if($request->roles){
            for ($i=0; $i < count($request->roles); $i++) { 
                //crear objeto empleado rol
                $empleadoRol = new EmpleadoRole();
                $empleadoRol->empleado_id = $empleado->id;
                $empleadoRol->rol_id = $request->roles[$i];
                $empleadoRol->save();
            }
        }

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id)->delete();

        //borrar arreglo de empleados y roles
        DB::table('empleado_roles')->where('empleado_id', $empleado->id)->delete();
        return redirect()->route('empleados.index')
            ->with('success', 'Empleado borrado correctamente');
    }
}
