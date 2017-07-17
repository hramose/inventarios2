@extends('layouts.master')

@section('content')

    <h1>Informes <a href="{{ url('informes/create') }}" class="btn btn-primary pull-right btn-sm">Add New Informe</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Custodio Id</th><th>Area Id</th><th>No Orden</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @php $x=0; @endphp
            @foreach($informes as $item)
                @php $x++;@endphp
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('informes', $item->id) }}">{{ $item->custodio_id }}</a></td><td>{{ $item->area_id }}</td><td>{{ $item->no_orden }}</td>
                    <td>
                        <a href="{{ url('informes/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['informes', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $informes->render() !!} </div>
    </div>

@endsection
