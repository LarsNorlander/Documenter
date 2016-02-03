<!-- Sidebar-Left Start -->
<section id="sidebarLeft">
    <div class="sidebarLeft">
        <ul class="sidebar-nav">
            <li>
                <a href="/dashboard" class="active">All Files</a>
            </li>
            <li>
                <a href="#">Shared with me</a>
            </li>
            <li>
                <a href="#">Departmental</a>
            </li>
            <li>
                <a href="#">Organizational</a>
            </li>
            <li>
                <a href="#">Memos</a>
            </li>
            @if(Auth::User()->user_type_id == 1)
                <li>
                    <a href="/admin">Admin Panel</a>
                </li>
            @endif
        </ul>
    </div>
</section>
<!-- Sidebar-Left End -->