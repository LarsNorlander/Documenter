<div class="modal fade" id="uploadFile" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="/" type="button" class="close">&times;</a>
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
                <a href="/" class="btn btn-default">Close</a>
            </div>
        </div>
    </div>
</div>