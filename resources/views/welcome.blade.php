@extends('masterPage')

@section('pageTitle')
    Documenter
@endsection

@section('body')
    <!-- Navigation bar -->
    <nav class="navbar navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Documenter</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li><a href="#">Overview</a></li>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>

                <!-- Login Form -->
                <form class="navbar-form navbar-right" role="search" action="./files">
                    <!-- Username -->
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <!-- Login Button -->
                    <button id="signIn" type="submit" class="btn btn-default"><span
                                class="glyphicon glyphicon-log-in"></span> Log In
                    </button>
                </form>
                <!-- End of Login Form -->
            </div>
        </div>
    </nav>
    <!-- End of Navigation bar -->

    <!-- Header -->
    <div id="head1">
        <br/>Documents made easy.
    </div>
    <!-- End of Header -->

    <!-- Contents go here -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h1><br/>Documenter. A document management system that makes sure your documents are safe, backed up and
                    shared to the right people.</h1><br/>
            </div>

            <div class="row">
                <div class="col-sm-6 content">

                </div>

                <div class="col-sm-6 content">

                </div>
            </div>
        </div>
    </div>
    <!-- End of Contents -->

@endsection