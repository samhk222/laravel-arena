@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <example-component></example-component>
    <p>Welcome to this beautiful admin panel.</p>

    @can('is-admin')
        Only admins can see this
    @endcan
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
