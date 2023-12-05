@extends('adminlte::page')

@section('template_title')
    {{ __('Update') }} Historial Cirujium
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Historial Cirujium</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('historial-cirujia.update', $historialCirujium->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('historial-cirujium.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
