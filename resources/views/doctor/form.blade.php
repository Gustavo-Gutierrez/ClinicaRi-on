<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('fecha_titulo') }}
            {{ Form::date('Fecha_titulo', $doctor->fecha_titulo, ['class' => 'form-control' . ($errors->has('fecha_titulo') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Titulo']) }}
            {!! $errors->first('fecha_titulo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
    {{ Form::label('especialidad_id', 'Especialidad') }}
    <select class="form-control{{ $errors->has('especialidad_id') ? ' is-invalid' : '' }}" name="especialidad_id">
        @foreach($specialties as $specialty)
            <option value="{{ $specialty->id }}" {{ $doctor->EspecialidadID == $specialty->id ? 'selected' : '' }}>
                {{ $specialty->Nombre }}
            </option>
        @endforeach
    </select>
    {!! $errors->first('especialidad_id', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('nombre', 'Nombre del Doctor') }}
    {{ Form::text('nombre', $doctor->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del Doctor']) }}
    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
</div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>