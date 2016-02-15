@if($file->doc_type_id == 1)
    <div class="card">
        <h6 id="infoFileName">{{$file->filename}}</h6><br/>

        <table width="100%">
            <tr>
                <td>Current Version:</td>
                <td>
                    {{$file->public_version}}
                </td>
            </tr>

            <tr>
                <td>Total Versions:</td>
                <td>
                    {{$file->total_versions}}
                </td>
            </tr>
        </table>
    </div>

@elseif(isset($achievement))
    <div class="card">
        <h6 id="infoFileName">{{$file->filename}}</h6><br/>

        <table width="100%">
            <tr>
                <td>Type:</td>
                <td>
                    {{$achievement->type}}
                </td>
            </tr>
            <tr>
                <td>Received:</td>
                <td>
                    {{$achievement->received}}
                </td>
            </tr>
            <tr>
                <td>Valid till:</td>
                <td>
                    {{$achievement->validity}}
                </td>
            </tr>
            <tr>
                <td>Verified:</td>
                <td>
                    @if($achievement->approved == "")
                        No
                    @else
                        Yes
                    @endif
                </td>
            </tr>
            <tr>
                <td><br/></td>
            </tr>
            <tr>
                <td>Details:</td>
            </tr>
            <tr>
                <td colspan="2">{{$achievement->details}}</td>
            </tr>
        </table>
    </div>
@endif