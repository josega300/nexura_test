<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpleadoRole
 *
 * @property $empleado_id
 * @property $rol_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Empleado $empleado
 * @property Role $role
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class EmpleadoRole extends Model
{
    
    static $rules = [
		'empleado_id' => 'required',
		'rol_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['empleado_id','rol_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empleado()
    {
        return $this->hasOne('App\Models\Empleado', 'id', 'empleado_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'rol_id');
    }
    

}
