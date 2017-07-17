@extends('layouts.master')

@section('content')

    <h1>Edit Estacione</h1>
    <hr/>

    {!! Form::model($estacione, [
        'method' => 'PATCH',
        'url' => ['estaciones', $estacione->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('estacion') ? 'has-error' : ''}}">
                {!! Form::label('estacion', 'Estacion: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('estacion', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('estacion', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit(trans('form.update'), ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection