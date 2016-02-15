<div class="card" id="tagsCard">
    <div class="card-head">
        <table width="100%">
            <tr>
                <td><h4>Tags</h4></td>
                <td>
                    <button class="btn btn-primary" style="float: right" id="tagButton">
                        <span class="glyphicon glyphicon-tags"></span>
                    </button>
                </td>
            </tr>
        </table>
        <hr/>
        <div>
            @if(count($tags) > 0)
                @foreach($tags as $tag)
                    <span class="label label-primary">{{$tag}}</span>
                @endforeach
            @else
                There are no tags on this document.
            @endif
        </div>
    </div>

</div>