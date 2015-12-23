@extends('masterPage')

@section('pageTitle')
    Files
    @endsection


    @section('body')
            <!-- Navigation start -->
    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Documenter</a>
            </div>
            <div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Upload New Document</a></li>
                    <li id="logOut"><a><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of navigation -->

    <!-- Sidebar start -->
    <div class="sidebar" id="no-content">
        <div id="no-content-text">
            Select a document to show it's info.
        </div>
    </div>

    <div class="sidebar" id="has-content">
        <div class="sidebar-head">
            Document Options
            <hr/>
        </div>
        <div class="card">
            <div>
                <h4>Sharing</h4>
                <hr/>
            </div>

            <div>
                Only Me
            </div>
        </div>

        <div class="card">
            <h4>Version</h4>
            <hr/>
            <div>

            </div>
        </div>

        <div class="sidebar-head">
            Document Details
            <hr/>
        </div>

        <div class="card">
            Current Active Version: <br/>
            Total Number of Versions: <br/>
            File Size:
        </div>
    </div>
    <!-- End of sidebar -->

    <!-- Area where list of files would be displayed -->
    <div class="file-list">
        <!-- File header -->
        <div class="file-header">
            Memos
        </div>

        @foreach($files as $file)
                <!-- File item -->
        <div class="file-item">
            <div class="file-name">{{ $file->filename }}</div>
            <div class="file-owner">{{ $file->owner_id }}</div>
            <div class="file-edited">{{ $file->updated_at }}</div>
        </div>
        @endforeach
    </div>
    <!-- End of file display section -->

    @endsection

    @section('footer')
            <!-- Page Specific script. Will be moved to it's own file. -->
    <script>
        $("nav").css("background", "white");

        $(".file-item").click(function () {
            $("#no-content").hide(0)
            $(".file-selected").toggleClass("file-selected")
            $(this).toggleClass("file-selected")
        })

        $(".file-list").css("width", $(window).width() - 300 + "px")

        $("#logOut").click(function () {
            window.open("/logout", "_self")
        })


        $(window).resize(function () {
            $(".file-list").css("width", $(window).width() - 300 + "px")
        });
    </script>
@endsection