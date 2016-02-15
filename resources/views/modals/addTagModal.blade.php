<div class="modal fade" id="addFileTag" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal Contents -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">File Sharing</h4>
            </div>
            {!! Form::open(['url' => '/user/addTag/', 'id' => 'addTagForm']) !!}
            <div class="modal-body">
                {!! Form::label("Tags", "Customize your tags (separate by pressing enter):") !!}
                <div class="tagsinput-primary">
                    {!! Form::text("Tags", null, ['class' => 'tagsinput', 'data-role' => 'tagsinput']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>