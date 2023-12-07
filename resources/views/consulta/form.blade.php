<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Diagnostico') }}
            {{ Form::text('Diagnostico', $consulta->Diagnostico, ['class' => 'form-control' . ($errors->has('Diagnostico') ? ' is-invalid' : ''), 'placeholder' => 'Diagnostico']) }}
            {!! $errors->first('Diagnostico', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fechahora') }}
            {{ Form::date('Fechahora', $consulta->Fechahora, ['class' => 'form-control' . ($errors->has('Fechahora') ? ' is-invalid' : ''), 'placeholder' => 'Fechahora']) }}
            {!! $errors->first('Fechahora', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Instrucciones') }}
            {{ Form::text('Instrucciones', $consulta->Instrucciones, ['class' => 'form-control' . ($errors->has('Instrucciones') ? ' is-invalid' : ''), 'placeholder' => 'Instrucciones']) }}
            {!! $errors->first('Instrucciones', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Motivo') }}
            {{ Form::text('Motivo', $consulta->Motivo, ['class' => 'form-control' . ($errors->has('Motivo') ? ' is-invalid' : ''), 'placeholder' => 'Motivo']) }}
            {!! $errors->first('Motivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Observacion') }}
            {{ Form::text('Observacion', $consulta->Observacion, ['class' => 'form-control' . ($errors->has('Observacion') ? ' is-invalid' : ''), 'placeholder' => 'Observacion']) }}
            {!! $errors->first('Observacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('CitaID') }}
            {{ Form::text('CitaID', $consulta->CitaID, ['class' => 'form-control' . ($errors->has('CitaID') ? ' is-invalid' : ''), 'placeholder' => 'Citaid']) }}
            {!! $errors->first('CitaID', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('PacienteID') }}
            {{ Form::text('PacienteID', $consulta->PacienteID, ['class' => 'form-control' . ($errors->has('PacienteID') ? ' is-invalid' : ''), 'placeholder' => 'Pacienteid']) }}
            {!! $errors->first('PacienteID', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('DoctorID') }}
            {{ Form::text('DoctorID', $consulta->DoctorID, ['class' => 'form-control' . ($errors->has('DoctorID') ? ' is-invalid' : ''), 'placeholder' => 'Doctorid']) }}
            {!! $errors->first('DoctorID', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>