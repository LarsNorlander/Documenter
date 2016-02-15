<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand"
               href="/">Documenter</a>
        </div>
        <ul class=" nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Upload
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#" data-toggle="modal" data-target="#uploadFile">Documents</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#uploadAchievement">Award</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                            class="glyphicon glyphicon-user"></span> {{ Auth::User()->fname }}
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#" id="logOut">Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>