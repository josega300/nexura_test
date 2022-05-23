@extends('layouts.app')

@section('template_title')
    Update Empleado
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Empleado</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('empleados.update', $empleado->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="form-group">
                                        {{ Form::label('nombre') }}
                                        {{ Form::text('nombre', $empleado->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                                        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('email') }}
                                        {{ Form::text('email', $empleado->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                                        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('sexo') }}<br>
                                        Masculino
                                        {{ Form::radio('sexo', 'M',true) }}<br>Femenino
                                        {{ Form::radio('sexo', 'F') }}<br>
                                        {!! $errors->first('sexo', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>


                                    <div class="form-group">
                                        {{ Form::label('Area') }}
                                        {{ Form::select('area_id', $areas ,$empleado->area_id, ['class' => 'form-control' . ($errors->has('area_id') ? ' is-invalid' : '')]) }}
                                        {!! $errors->first('area_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>



                                    <div class="form-group">
                                        {{ Form::label('descripcion') }}
                                        {{ Form::text('descripcion', $empleado->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                                        {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::checkbox('boletin', $bolValue, $checkBoletin) }}
                                        Deseo recibir boletin informativo
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('Roles') }}

                                        <?php //dd($roles[0]->id, $rolesEmp[0]->rol_id);
                                            for ($i=0; $i < count($roles); $i++) { 
                                                $valorCheck = false;
                                                ?>
                                                <div class="checkbox">
                                                    <label>
                                        <?php   for ($j=0; $j < count($rolesEmp); $j++) { 
                                                    if($roles[$i]->id == $rolesEmp[$j]->rol_id){ 
                                                            $valorCheck = true;
                                                    } 
                                                } ?>
                                                <?php echo Form::checkbox('roles[]', $roles[$i]->id, $valorCheck); ?>
                                                    {{$roles[$i]->nombre}}
                                                    </label>
                                                </div>
                                        <?php } ?>
                                        {!! $errors->first('roles', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
