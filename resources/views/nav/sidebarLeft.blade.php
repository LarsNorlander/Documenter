<!-- Sidebar-Left Start -->
<section id="sidebarLeft">
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
                <a href="#">Awards</a>
            </li>
            <li>
                <a href="#">Memos</a>
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
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</section>
<!-- Sidebar-Left End -->