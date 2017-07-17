@extends('layouts.master')

@section('content')

    <h1>Orden</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>OrdenCompra</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $orden->id }}</td> <td> {{ $orden->ordenCompra }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection