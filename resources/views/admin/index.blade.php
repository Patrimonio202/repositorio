@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between admin-page-heading">
        <div>
            <span class="admin-eyebrow">Administración</span>
            <h1>Panel principal</h1>
        </div>
        <span class="admin-date"><i class="far fa-calendar-alt"></i> {{ now()->translatedFormat('d M, Y') }}</span>
    </div>
@stop

@section('content')
 @livewire('admin.dashboard')    
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('csspersonalizados/admin-modern.css') }}">
@stop

@section('js')

@stop
