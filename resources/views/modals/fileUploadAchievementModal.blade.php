<div class="modal fade" id="uploadAchievement" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal Contents -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload a Credential</h4>
            </div>
            {!! Form::open(['url' => '/file/upload/achievement', 'id' => 'fileTagForm', 'files' => true]) !!}
            <div class="modal-body">
                <p style="font-size: 16px">* Denotes a required field.</p>
                {!! Form::label("file", "Choose File for Credential*") !!}
                {!! Form::file("file", ['class' => 'form-control', 'required', 'accept'=>'.pdf']) !!}
                {!! Form::label("name", "Title of Achievement*") !!}
                {!! Form::text("name", null, ['class' => 'form-control', 'required']) !!}
                {!! Form::label("type", "Specify what kind of award it is*") !!}
                {!! Form::text("type", null, ['class' => 'form-control', 'required']) !!}
                {!! Form::label("received", "Date Received*") !!}
                <input id="received" name="received" type="date" class="form-control" required>
                {!! Form::label("validity", "Valid till (set to the same date if it does not apply)*") !!}
                <input id="validity" name="validity" type="date" class="form-control">
                {!! Form::label("details", "Additional details") !!}
                {!! Form::textarea("details", null, ['class'=>'form-control']) !!}
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('Upload', ['class' => 'btn btn-primary']) !!}

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

{{--
$table->increments('id');
            $table->string('name');
            $table->date('received');
            $table->string('type');
            $table->date('validity');
            $table->longText('details');
            $table->boolean('univ');
            $table->boolean('approved');
            $table->boolean('deletePending');
            $table->integer('achievement_id')->unsigned();
            $table->foreign('achievement_id')->references('id')->on('tbl_file_records');
            $table->timestamps();
--}}