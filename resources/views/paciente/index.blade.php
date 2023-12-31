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
                                <a href="{{ route('pacientes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Ci</th>
										<th>Direccion</th>
										<th>Email</th>
										<th>Estado Civil</th>
										<th>Fecha Nacimiento</th>
										<th>Lugar Nacimiento</th>
										<th>Nacionalidad</th>
										<th>Nombre</th>
										<th>Profesion</th>
										<th>Telefono</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pacientes as $paciente)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $paciente->Ci }}</td>
											<td>{{ $paciente->Direccion }}</td>
											<td>{{ $paciente->Email }}</td>
											<td>{{ $paciente->Estado_civil }}</td>
											<td>{{ $paciente->Fecha_nacimiento }}</td>
											<td>{{ $paciente->Lugar_nacimiento }}</td>
											<td>{{ $paciente->Nacionalidad }}</td>
											<td>{{ $paciente->Nombre }}</td>
											<td>{{ $paciente->Profesion }}</td>
											<td>{{ $paciente->Telefono }}</td>

                                            <td>
                                                <form action="{{ route('pacientes.destroy',$paciente->id) }}" method="POST">
                               
                              
                                <a href="{{ route('historials.show', $paciente->id) }}" class="btn btn-primary">Historial</a>
                      
                                                    <a class="btn btn-sm btn-primary " href="{{ route('pacientes.show',$paciente->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('pacientes.edit',$paciente->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $pacientes->links() !!}
            </div>
        </div>
    </div>
@endsection
