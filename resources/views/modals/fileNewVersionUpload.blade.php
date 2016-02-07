<div class="modal fade" id="updateFile" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload your documents</h4>
            </div>
            {!! Form::open(['url' => "/file/update",
                                'id'     => 'fileUpdateForm',
                                'method' => 'post',
                                'files' => true]) !!}
            <div class="modal-body">
                {!! Form::label('updateFile', 'Select a file:') !!}
                {!! Form::file('updateFile', ['class' => 'form-control','accept' => '.pdf', 'required']) !!}

            </div>
            <div class="modal-footer">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>