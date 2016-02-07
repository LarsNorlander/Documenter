@extends('masterPage')

@section('pageTitle')
    Dashboard
@stop

@section('body')
    {{-- Navigation start --}}
    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand"
                   href="/">Documenter</a>
            </div>
            <ul class=" nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                                class="glyphicon glyphicon-user"></span> {{ Auth::User()->fname }}
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Settings</a></li>
                        <li><a href="#" id="logOut">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    {{-- End of navigation --}}

    {{-- Sidebar-Left Start --}}
    @include('nav.sidebarLeft')
    {{-- Sidebar-Left End --}}

    <section id="fileDisplay">
        <div class="file-list">
            {{-- File header --}}
            @if( ! empty($allFiles))
                @foreach($allFiles as $file)
                    {{-- File item --}}
                    <div class="file-item-even" id="{{ $file->id }}">
                        <div class="file-name">{{ $file->filename }}</div>
                        <div class="file-owner">{{ $file->user->fname . " " . $file->user->lname }}</div>
                        <div class="file-edited">{{ date('F d, Y', strtotime($file->updated_at)) }}</div>
                    </div>
                @endforeach
            @endif

            @if( ! empty($allDepts))
                <div class="file-header">Departments</div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addDept"
                        style="margin-left: 10px; margin-bottom:20px">Add Department
                </button>
                @foreach($allDepts as $file)
                    {{-- File item --}}
                    <div class="file-item-even" id="{{ $file->id }}">
                        <div class="btn-group">
                            <button class="btn btn-primary" id="editButton"
                                    data-toggle="modal" data-target="#fileShare">
                                <span class="glyphicon glyphicon-edit"></span>
                            </button>
                            <a href="/admin/del/dept/{{$file->id}}">
                            <button class="btn btn-danger" id="deleteButton">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                            </a>
                        </div>
                        <div class="file-name" style="margin-left:10px">{{ $file->name }}</div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
    {{-- End of file display section --}}

    {{-- Modals --}}
    <div class="modal fade" id="addDept" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            {{-- Modal Contents --}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload your documents</h4>
                </div>
                <form action="/admin/add/dept" method="post" style="margin:20px" id="addDeptForm">
                    <label>College name:</label>
                    <input name="collegeName" type="text" class="form-control">
                    {!! csrf_field() !!} <br/>
                    <input name="submit" type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>


    {{-- End of Modals --}}

@section('footer')
    {{-- Page Specific script. Will be moved to it's own file. --}}
    <script src="/js/dropzone.js"></script>
    <script src="/js/application.js"></script>

    <script>
        $(".file-list").css("width", $(window).width() - 200 + "px");

        $("#logOut").click(function () {
            event.preventDefault();
            window.open("/logout", "_self");
        });

        $(window).resize(function () {
            $(".file-list").css("width", $(window).width() - 200 + "px");
        });
    </script>

@stop