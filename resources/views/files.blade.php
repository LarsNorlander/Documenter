@extends('masterPage')

@section('pageTitle')
    Files
@endsection


@section('body')
    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Documenter</a>
            </div>
            <div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Upload New Document</a></li>
                    <li><a href="#">New Folder</a></li>
                    <li id="logOut"><a><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>

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
                Version 1 : 12 Dec 2015
            </div>
        </div>

        <div class="sidebar-head">
            Document Details
            <hr/>
        </div>

        <div class="card">
            Current Active Version: 1 <br/>
            Total Number of Versions: 1 <br/>
            File Size: 200kb
        </div>
    </div>

    <div class="file-list">
        <div class="file-header">
            Memos
        </div>

        <div class="file-item">
            <div class="file-name">Community Mass</div>
            <div class="file-owner">CCF</div>
            <div class="file-edited">11 Dec 2015</div>
        </div>

        <div class="file-item">
            <div class="file-name">No Classes</div>
            <div class="file-owner">AUF</div>
            <div class="file-edited">14 Dec 2015</div>
        </div>

        <div class="file-header">
            Documents
        </div>

        <div class="file-item">
            <div class="file-name">Class Curriculum</div>
            <div class="file-owner">Me</div>
            <div class="file-edited">12 Dec 2015</div>
        </div>

        <div class="file-item">
            <div class="file-name">References</div>
            <div class="file-owner">Me</div>
            <div class="file-edited">12 Dec 2015</div>
        </div>

        <div class="file-header">
            Certifications And Awards
        </div>

        <div class="file-item">
            <div class="file-name">Google Apps for Education</div>
            <div class="file-owner">Me</div>
            <div class="file-edited">03 Apr 2015</div>
        </div>

        <div class="file-item">
            <div class="file-name">PLDT Hackathon</div>
            <div class="file-owner">Me</div>
            <div class="file-edited">16 Apr 2015</div>
        </div>

        <div class="file-item">
            <div class="file-name">Swift iOS Training</div>
            <div class="file-owner">Me</div>
            <div class="file-edited">05 Dec 2015</div>
        </div>

        <div class="file-item">
            <div class="file-name">Toro.io Hackathon</div>
            <div class="file-owner">Me</div>
            <div class="file-edited">15 Oct 2015</div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        $("nav").css("background", "white");

        $(".file-item").click(function () {
            $("#no-content").hide(0)
            $(".file-selected").toggleClass("file-selected")
            $(this).toggleClass("file-selected")
        })

        $(".file-list").css("width", $(window).width() - 300 + "px")

        $("#logOut").click(function () {
            window.open("..", "_self")
        })


        $(window).resize(function () {
            $(".file-list").css("width", $(window).width() - 300 + "px")
        });
    </script>
@endsection