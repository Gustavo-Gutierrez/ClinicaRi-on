@extends('adminlte::page')

@section('template_title')
Paciente
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Paciente') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('pacientes.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
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
            <th colspan="6">Reportes</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <a href="{{ route('pacientes.index') }}" class="btn btn-primary">Reporte de Historial Clínico de Pacientes</a>
            </td>
            <td>
                <a href="{{ route('facturas.index') }}" class="btn btn-primary">Reporte de Facturación</a>
            </td>
            <td>
                <a href="{{ route('calendario') }}" class="btn btn-primary">Reporte de Gestión de Horarios y Turnos</a>
            </td>
            <td>
                <a href="{{ route('cirujias.index') }}" class="btn btn-primary">Reporte de Programación de Cirugías</a>
            </td>
            <td>
                <a href="{{ route('analisis.index') }}" class="btn btn-primary">Reporte de Generación de Laboratorio</a>
            </td>
            <td>
                <a href="#" class="btn btn-primary">Reporte de Reconocimiento de Imagen</a>
            </td>
        </tr>
    </tbody>
</table>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
@endsection