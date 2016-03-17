<div class="modal fade" id="searchTag" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal Contents -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Search Tags</h4>
            </div>
            {!! Form::open(['url' => '/tag/search', 'id' => 'searchTagForm']) !!}
            <div class="modal-body">
                {!! Form::label("searchTags", "Enter a tag you want to look for.") !!}
                <br/>
                <select id="searchTags" name="Tags[]" multiple="multiple" class="form-control multiselect multiselect-primary">
                    @foreach($userTags as $userTag)
                        <option value="{{$userTag}}">{{$userTag}}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('Go', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>