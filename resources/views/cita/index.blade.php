@extends('adminlte::page')

@section('template_title')
    Cita
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cita') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('citas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Fechahora</th>
										<th>Paciente</th>
										<th>Personal</th>
										<th>Turno</th>
										<th>Especialidad</th>
                                        <th>Doctor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($citas as $cita)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $cita->Fechahora }}</td>
											<td>{{ $cita->Paciente->Nombre }}</td>
											<td>{{ $cita->Personal->user->name }}</td>
											<td>{{ $cita->Turno->Hora_inicio."--".$cita->Turno->Hora_fin }}</td>
											<td>{{ $cita->Especialidad->Nombre }}</td>
                                            <td>
                                            @if ($cita->Especialidad->doctors->isNotEmpty())
                                            {{ $cita->Especialidad->doctors->first()->user->name }}
                                             @endif
                                            </td>

                                            <td>
                                                <form action="{{ route('citas.destroy',$cita->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('citas.show',$cita->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('citas.edit',$cita->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $citas->links() !!}
            </div>
        </div>
    </div>
@endsection
