{{-- Sidebar-Right Start --}}
<div class="sidebarRight" id="no-content">
    <div id="no-content-text">
        Select a document to show it's info.
    </div>
</div>

<div class="sidebarRight" id="has-content">
    <div class="sidebar-head">
        Document Details
        <hr/>
    </div>

    @include('nav.cards.fileInfo')

    <section id="documentOptions">
        <div class="sidebar-head">
            Document Options
            <hr/>
        </div>

        <div id="sharingCard"></div>
        <div id="versionCard"></div>
    </section>

</div>
{{-- End of sidebar --}}