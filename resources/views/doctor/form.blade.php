<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Arfecha_titulo') }}
            {{ Form::date('Arfecha_titulo', $doctor->Arfecha_titulo, ['class' => 'form-control' . ($errors->has('Arfecha_titulo') ? ' is-invalid' : ''), 'placeholder' => 'Arfecha Titulo']) }}
            {!! $errors->first('Arfecha_titulo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('EspecialidadID') }}
            {{ Form::text('EspecialidadID', $doctor->EspecialidadID, ['class' => 'form-control' . ($errors->has('EspecialidadID') ? ' is-invalid' : ''), 'placeholder' => 'Especialidadid']) }}
            {!! $errors->first('EspecialidadID', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>