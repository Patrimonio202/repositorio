@extends('adminlte::page')

@section('title', 'Cultura')

@section('content_header')
    <h1>Tablero principal</h1>
@stop

@section('content')
 @livewire('admin.dashboard')    
@stop

@section('css')
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
     <!-- https://themeon.net/nifty/v2.9.1/icons-ionicons.html -->
   
@stop

@section('js')

@stop
