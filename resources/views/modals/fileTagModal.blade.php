<div class="modal fade" id="addTagToFile" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal Contents -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tag This Document</h4>
            </div>
            {!! Form::open(['url' => '/file/addTag/' . $id, 'id' => 'fileTagForm']) !!}
            <div class="modal-body">
                {!! Form::label("Tags", "Tag Document") !!}
                <br/>
                <select name="Tags[]" multiple="multiple" class="form-control multiselect multiselect-info">
                    @foreach($userTags as $userTag)
                        <option value="{{$userTag}}" @if(in_array($userTag, $docTags)) selected @endif>{{$userTag}}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>