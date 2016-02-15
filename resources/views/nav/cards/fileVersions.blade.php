@if($docType == 1)
    <div class="card" id="versionsCard">
        <table width="100%">
            <tr>
                <td><h4>Versions</h4></td>
                <td>
                    <button class="btn btn-primary" style="float: right" data-toggle="modal"
                            data-target="#updateFile" id="addVerButton"><span
                                class="glyphicon glyphicon-cloud-upload"></span></button>
                </td>
            </tr>
        </table>
        <hr/>
        <div class="version-list">
            @foreach($files as $file)
                <div class="version-label">Version {{ $file }}</div>
                <div class="version-options">
                    <div class="btn-group">
                        <a href="/file/setPublic/{{$id}}/{{$file}}" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-check"></span></a>
                        <a href="/file/{{$id}}/{{$file}}" target="_blank" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-eye-open"></span></a>
                        <button id="{{$id}}/{{$file}}" class="btn btn-danger del-ver"><span
                                    class="glyphicon glyphicon-trash"></span></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif