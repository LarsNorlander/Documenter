<!-- Sidebar-Right Start -->
<section id="sidebarRight">
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

        <div class="card">
            <h6 id="infoFileName">null</h6><br/>

            <table width="100%">
                <tr>
                    <td>Current Version:</td>
                    <td>
                        <file-data id="activeVer">null</file-data>
                    </td>
                </tr>

                <tr>
                    <td>Total Versions:</td>
                    <td>
                        <file-data id="totalVer">null</file-data>
                    </td>
                </tr>

                <tr>
                    <td><span class="glyphicon glyphicon-tag"> </span>Tags:</td>
                    <td>
                        <file-data id="totalVer">None</file-data>
                    </td>
                </tr>
            </table>
        </div>

        <section id="documentOptions">
            <div class="sidebar-head">
                Document Options
                <hr/>
            </div>
            <div class="card" id="sharingCard">
                <div class="card-head">
                    <table width="100%">
                        <tr>
                            <td><h4>Sharing</h4></td>
                            <td>
                                <button class="btn btn-primary" style="float: right" id="shareButton"
                                        data-toggle="modal" data-target="#fileShare">
                                    <span class="glyphicon glyphicon-share"></span>
                                </button>
                            </td>
                        </tr>
                    </table>
                    <hr/>
                </div>
                <div>
                    <p id="sharing"><span class="glyphicon glyphicon-lock"></span> Only Me</p>
                </div>
            </div>

            <div class="card" id="versionsCard">
                <table width="100%">
                    <tr>
                        <td><h4>Versions</h4></td>
                        <td>
                            <button class="btn btn-primary" style="float: right" data-toggle="modal"
                                    data-target="" id="addVerButton"><span
                                        class="glyphicon glyphicon-cloud-upload"></span></button>
                        </td>
                    </tr>
                </table>
                <hr/>
                <div>
                    <table width="100%">
                        <tr>
                            <td>Version 1</td>
                            <td align="right">
                                <div class="btn-group">
                                    <button class="btn btn-primary"><span
                                                class="glyphicon glyphicon-check"></span></button>
                                    <button class="btn btn-primary"><span
                                                class="glyphicon glyphicon-eye-open"></span></button>
                                    <button class="btn btn-danger"><span
                                                class="glyphicon glyphicon-trash"></span></button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>

    </div>
</section>
<!-- End of sidebar -->