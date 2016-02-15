<div id="delAward" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you sure you want to delete the file?</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => '/award/delReq', 'id' => 'awardDelForm']) !!}
                {!! Form::label('delDetails', "Why do you want to delete this file?") !!}
                {!! Form::textArea('delDetails', null, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="modal-footer">

                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                {!! Form::submit('Confirm', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
