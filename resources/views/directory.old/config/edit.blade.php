@extends('layouts.master')

@section('content')

    <h1>Edit Config</h1>
    <hr/>

    {!! Form::model($config, [
        'method' => 'PATCH',
        'url' => ['config', $config->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('atributo') ? 'has-error' : ''}}">
                {!! Form::label('atributo', 'Atributo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('atributo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('atributo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('tipo') ? 'has-error' : ''}}">
                {!! Form::label('tipo', 'Tipo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('tipo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('tipo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('valores_fuente') ? 'has-error' : ''}}">
                {!! Form::label('valores_fuente', 'Valores Fuente: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('valores_fuente', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('valores_fuente', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('fijo') ? 'has-error' : ''}}">
                {!! Form::label('fijo', 'Fijo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('fijo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('fijo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('valor') ? 'has-error' : ''}}">
                {!! Form::label('valor', 'Valor: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('valor', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
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