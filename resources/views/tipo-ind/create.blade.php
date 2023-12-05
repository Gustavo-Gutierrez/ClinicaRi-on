@extends('adminlte::page')

@section('template_title')
    {{ __('Create') }} Tipo Ind
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Tipo Ind</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tipo-inds.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('tipo-ind.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection