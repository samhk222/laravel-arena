@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
    <p>I was planning to leave some mask configuration here (for the numbers) but I chose to leave it as a parameter
        inside the <strong><i>.env</i></strong>.</p>

    <p> To test admin features, just try to delete a number preferences with a regular user...</p>
@stop
