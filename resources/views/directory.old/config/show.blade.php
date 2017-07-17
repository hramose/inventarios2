@extends('layouts.master')

@section('content')

    <h1>Config</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Atributo</th><th>Tipo</th><th>Valores Fuente</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $config->id }}</td> <td> {{ $config->atributo }} </td><td> {{ $config->tipo }} </td><td> {{ $config->valores_fuente }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection