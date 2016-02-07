@extends('masterPage')

@section('pageTitle')
    Dashboard
@stop

@section('head')
    {{-- Page specific styling goes here. --}}
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
@stop

@section('body')
    {{-- Import all navigation files required go here. --}}
    @include('nav.navbarTop')
    @include('nav.sidebarLeft')
    @include('nav.sidebarRight')

    {{-- Main display goes here. --}}
    @include('displays.fileDisplay')

    {{-- Modals go here. --}}
    @include('modals.fileUploadModal')
    @include('modals.sharingModal')
    @include('modals.confirmFileDelModal')
    @include('modals.fileNewVersionUpload')
@stop

@section('footer')
    {{-- Page specific scripts go here. --}}
    <script src="{{asset('js/dropzone.js')}}"></script>
    <script src="{{asset('js/dashboard.js')}}"></script>
@stop