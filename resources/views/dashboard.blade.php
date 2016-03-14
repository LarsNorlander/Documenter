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

    @if(isset($delReq))
        @include('nav.sidebarRightDelReq')
    @elseif(!isset($noSidebar))
        @include('nav.sidebarRight')
    @endif
    {{-- Main display goes here. --}}
    @if(isset($screen))
        @if($screen == "verify")
            @include('displays.verificationDisplay')
        @elseif($screen == "admin")
            @include('displays.admin.adminDisplay')
        @elseif($screen == "deptAwards")
            @include('displays.deptAwardsDisplay')
        @endif
    @else
        @include('displays.fileDisplay')
    @endif

    {{-- Modals go here. --}}
    @include('modals.fileUploadModal')
    @include('modals.fileUploadAchievementModal')
    <div id="modalSharing"></div>
    @include('modals.confirmFileDelModal')
    @include('modals.fileNewVersionUpload')
    @include('modals.addTagModal')
    @include('modals.delReqAward')
    @include('modals.searchTagModal')
    <div id="modalFileTag"></div>

@stop

@section('footer')
    {{-- Page specific scripts go here. --}}
    <script src="{{asset('js/dropzone.js')}}"></script>
    @if(isset($noSidebar))
        <script src="{{asset('js/dashboard_noSide.js')}}"></script>
    @elseif(isset($delReq))
        <script src="{{asset('js/delReq.js')}}"></script>
    @else
        <script src="{{asset('js/dashboard.js')}}"></script>
    @endif
@stop