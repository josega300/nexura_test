@extends('layouts.app')

@section('template_title')
    {{ $empleado->name ?? 'Detalle Empleado' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Detalle Empleado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('empleados.index') }}"> Atras</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $empleado->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $empleado->email }}
                        </div>
                        <div class="form-group">
                            <strong>Sexo:</strong>

                            <?php if ($empleado->sexo == 'M') { ?>
                                <td>Masculino</td>
                            <?php }else{ ?>
                                <td>Femenino</td>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <strong>Area :</strong>
                            {{ $empleado->area->nombre}}
                        </div>
                        <div class="form-group">
                            <strong>Boletin:</strong>
                            <?php if ($empleado->boletin == 1) { ?>
                                <td>Si</td>
                            <?php }else{ ?>
                                <td>No</td>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $empleado->descripcion }}
                        </div>

                        </br>
                        <div class="form-group">
                            <h4>Roles</h4>

                            @foreach($roles as $role)
                            <div class="checkbox">
                                <label>
                                    {{$role}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        {{ $texto }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
