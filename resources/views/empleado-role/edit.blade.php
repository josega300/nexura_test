@extends('layouts.app')

@section('template_title')
    Update Empleado Role
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Empleado Role</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('empleado-roles.update', $empleadoRole->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('empleado-role.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
