@extends('masterPage')

@section('pageTitle')
    Dashboard
    @endsection


    @section('body')
            <!-- Navigation start -->
    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand"
                   href="#">{{ Auth::user()->fname . " " . Auth::user()->lname . " &middot; " . Auth::user()->user_dept_id }}</a>
            </div>
            <div>
                <div class="nav navbar-form navbar-right">
                    <button class="btn btn-default" data-toggle="modal" data-target="#uploadFile">Upload Document
                    </button>
                    <button class="btn btn-default" id="logOut"><span class="glyphicon glyphicon-log-out"></span> Log
                        Out
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <!-- End of navigation -->

    <!-- Modal -->
    <div class="modal fade" id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload a file</h4>
                </div>
                <form action="/upload" method="post">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        Select a file (PDF format)
                        <input class="form-control" type="file">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

        @if(count($files) < 0)
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
        @else
            <div class="file-header">
                Nothing to show. Click on Upload New Document to get started.
            </div>
        @endif
    </div>
    <!-- End of file display section -->

    @endsection

    @section('footer')
            <!-- Page Specific script. Will be moved to it's own file. -->
    <script>
        //$("nav").css("background", "white");

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