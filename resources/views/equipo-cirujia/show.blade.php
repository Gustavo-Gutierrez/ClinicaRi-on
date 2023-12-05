@extends('adminlte::page')

@section('template_title')
    {{ $equipoCirujia->name ?? "{{ __('Show') Equipo Cirujia" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Equipo Cirujia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('equipo-cirujias.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Equipoid:</strong>
                            {{ $equipoCirujia->EquipoID }}
                        </div>
                        <div class="form-group">
                            <strong>Usuarioid:</strong>
                            {{ $equipoCirujia->UsuarioID }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
