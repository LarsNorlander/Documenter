<div class="modal fade" id="uploadFile" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload your documents</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['url' => "/upload",
                                'class'  => 'dropzone',
                                'id'     => 'my-awesome-dropzone',
                                'method' => 'post']) !!}
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>