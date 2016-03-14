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
    @if(count($sharing['users']) == 0 and count($sharing['departments']) == 0 and  $sharing['mass'] == "0")
        <div>
            <p><span class="glyphicon glyphicon-lock"></span> Only Me</p>
        </div>
    @endif

    @unless(count($sharing['users']) == 0)
        <div>
            <p><span class="glyphicon glyphicon-user"></span> Shared with users</p>
        </div>
    @endunless

    @unless(count($sharing['departments']) == 0)
        <div>
            <p><span class="glyphicon glyphicon-briefcase"></span> Shared with departments</p>
        </div>
    @endunless

    @unless($sharing['mass'] == "0")
        <div>
            <p><span class="glyphicon glyphicon-eye-open"></span>
                @if($sharing['mass'] == "1")
                    Shared with AUF
                @elseif($sharing['mass'] == "2")
                    Anyone with a link
                @endif
            </p>
        </div>
    @endunless
</div>
