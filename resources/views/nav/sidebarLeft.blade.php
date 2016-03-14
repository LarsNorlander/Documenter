{{-- Sidebar-Left Start --}}
<div class="sidebarLeft">
    <ul class="sidebar-nav">
        <li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Documents <span class="caret"></span></a>
            <ul class="dropdown-menu palette-midnight-blue" role="menu">
                <li><a href="/dashboard/myfiles">My Files</a></li>
                <li><a href="/dashboard/shared">Shared With Me</a></li>
                <li><a href="/dashboard/dept">Departmental</a></li>
                <li><a href="/dashboard/org">Organizational</a></li>
            </ul>
        </li>
        <li>
            <a href="/dashboard/awards">Credentials</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tags <span class="caret"></span></a>
            <ul class="dropdown-menu palette-midnight-blue" role="menu">
                <li><a href="#" data-toggle="modal" data-target="#addFileTag"><span
                                class="glyphicon glyphicon-plus-sign"></span> New Tag</a></li>
                <li><a href="#" data-toggle="modal" data-target="#searchTag"><span
                                class="glyphicon glyphicon-search"></span> Search Tag</a></li>
                @foreach($userTags as $tag)
                    <li><a href="/dashboard/tags/{{$tag}}">{{$tag}}</a></li>
                @endforeach

            </ul>
        </li>
        @if(Auth::User()->user_type_id == 1)
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Panel <span
                            class="caret"></span></a>
                <ul class="dropdown-menu palette-midnight-blue nav-drop" role="menu">
                    <li><a href="/admin">All files in system</a></li>
                    <li><a href="/admin/depts">Departments</a></li>
                    <li><a href="/admin/users">Users</a></li>
                    <li><a href="/admin/delete">Delete Requests</a></li>
                    <li><a href="/admin/deleted">Deleted Credentials</a></li>
                </ul>
            </li>
        @endif
        @if(Auth::User()->user_type_id == 2)
            <li>
               <a href="/dashboard/deptAwards">Dept Credentials</a>
            </li>
            <li>
                <a href="/dashboard/deptArchived">Credential Archive</a>
            </li>
        @endif
        @if(Auth::User()->user_type_id == 2 and Auth::User()->user_dept_id == 2)
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">HR Panel <span
                            class="caret"></span></a>
                <ul class="dropdown-menu palette-midnight-blue nav-drop" role="menu">
                    <li><a href="/hr/verify">Verifications</a></li>
                    <li><a href="/hr/awards">List All Awards</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>
{{-- Sidebar-Left End --}}