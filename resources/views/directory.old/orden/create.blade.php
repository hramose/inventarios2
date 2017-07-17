@extends('layouts.master')

@section('content')

    <h1>Create New Orden</h1>
    <hr/>

    {!! Form::open(['url' => 'orden', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('ordenCompra') ? 'has-error' : ''}}">
                {!! Form::label('ordenCompra', 'Ordencompra: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('ordenCompra', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('ordenCompra', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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