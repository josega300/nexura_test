@extends('layouts.app')

@section('template_title')
    Empleado Role
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Empleado Role') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('empleado-roles.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Empleado Id</th>
										<th>Rol Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleadoRoles as $empleadoRole)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $empleadoRole->empleado_id }}</td>
											<td>{{ $empleadoRole->rol_id }}</td>

                                            <td>
                                                <form action="{{ route('empleado-roles.destroy',$empleadoRole->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('empleado-roles.show',$empleadoRole->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('empleado-roles.edit',$empleadoRole->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $empleadoRoles->links() !!}
            </div>
        </div>
    </div>
@endsection
