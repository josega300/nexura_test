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
            <?php echo Form::checkbox('boletin', 0); ?>
            Deseo recibir boletin informativo
        </div>

        <div class="form-group">
            {{ Form::label('Roles') }}
            @foreach($roles as $role)
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="{{$role->id}}" name="roles[]" value="{{$role->id}}">
                    {{$role->nombre}}
                </label>
            </div>
            @endforeach
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>