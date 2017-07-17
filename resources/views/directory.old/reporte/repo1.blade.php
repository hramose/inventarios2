@extends('layouts.master')


@section('content')
    <style>
        .scroll-area{
            width: 100%;
            height: 100%;
            overflow: scroll;
        }
    </style>
    <h1>@lang('form.equipos')<a href="{{ url('reporte1excel') }}" class="btn btn-primary pull-right btn-sm"><i class='fa fa-file-excel-o'></i> Excel</a></h1>


        <div class=" scroll-area">
        @include('directory.reporte.repo1excel')
        </div>

@endsection
