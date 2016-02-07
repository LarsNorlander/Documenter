<div id="delFile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you sure you want to delete the file?</h4>
            </div>
            <div class="modal-body">
                Doing so is irreversible. Confirm if you really want to delete this file.
            </div>
            <div class="modal-footer">
                {!! Form::open(['url' => '/file/del', 'id' => 'fileDelForm']) !!}
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                {!! Form::submit('Confirm', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
