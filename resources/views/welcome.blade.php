@extends('masterPage')

@section('pageTitle')
    Documenter
    @endsection

    @section('body')
            <!-- Navigation bar -->
    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">Documenter</a>
            </div>
            <div>
                <!-- Login Form -->
                <form class="navbar-form navbar-right" method="post" action="/login">
                    {!! csrf_field() !!}
                            <!-- Username -->
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="Password">
                    </div>
                    <!-- Login Button -->
                    <button id="signIn" type="submit" class="btn btn-primary"><span
                                class="glyphicon glyphicon-log-in"></span> Login
                    </button>
                </form>
                <!-- End of Login Form -->
            </div>
        </div>
    </nav>
    <!-- End of Navigation bar -->

    <!-- Header -->
    <div id="head1">
        <img src="{{asset('img/vector/logo.svg')}}" width="auto" height="270" style="margin-right: 50px">Documents made
        easy.
    </div>
    <!-- End of Header -->

    <!-- Contents go here -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h3 class="light-h3"><br/>Documenter. A document management system that makes sure your documents are
                    safe, backed up and
                    shared to the right people.</h3><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h5 class="light-h5">Sharing documents shouldn't mean walking from one office to another. Getting
                    records shouldn't mean
                    looking tirelessly for that one certificate wherever it could be. Documenter is a central bank for
                    storing all your documents for easy retrieval, sharing and safekeeping. Document work should be a little
                    more like this.</h5>
                <br/>
                <img src="{{asset('img/mac_mockup.png')}}" width="70%"
                     style="display: block; margin-left: auto; margin-right: auto">
            </div>
        </div>
    </div>
    <!-- End of Contents -->
@endsection

@section('footer')
    <div class="footer">
        Developed by lars.nrlndr and my awesome team with wit and class. <span class="glyphicon glyphicon-glass"></span>
    </div>
@stop

