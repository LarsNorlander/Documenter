<div class="modal fade" id="fileShare" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal Contents -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">File Sharing</h4>
            </div>
            {!! Form::open(['url' => '/file/sharing', 'id' => 'fileSharingForm']) !!}
            <div class="modal-body">

                {!! Form::label("Users", "Share with users:") !!}
                <div class="tagsinput-primary">
                    {!! Form::text("Users", null, ['class'     => 'tagsinput', 'data-role' => 'tagsinput']) !!}
                </div>
                {!! Form::label("Departments", "Share with departments:") !!}
                <div class="tagsinput-primary">
                    {!! Form::text("Departments", null, ['class'     => 'tagsinput', 'data-role' => 'tagsinput']) !!}
                </div>
                {!! Form::label("Mass", "Mass sharing") !!}
                <br/>
                {!! Form::select("Mass",
                    ['None', 'Organizational', 'Public'],
                    '0',
                    [ 'class' => 'form-control select select-primary select-block']) !!}
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>