<div class="modal fade" id="fileShare" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal Contents -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">File Sharing</h4>
            </div>
            {!! Form::open(['url' => '/file/sharing/' . $id, 'id' => 'fileSharingForm']) !!}
            <div class="modal-body">

                {!! Form::label("Users", "Share with users:") !!}
                <br/>
                <select name="Users[]" multiple="multiple" class="form-control multiselect multiselect-primary">
                    @foreach($users as $user)
                        <option value="{{$user->username}}" @if(in_array($user->username, $sharedUsers)) selected @endif>{{$user->username}}</option>
                    @endforeach
                </select>
                <br/>

                {!! Form::label("Editors", "Users that could edit:") !!}
                <br/>
                <select name="Editors[]" multiple="multiple" class="form-control multiselect multiselect-primary">
                    @foreach($users as $user)
                        <option value="{{$user->username}}" @if(in_array($user->username, $sharedUsers)) selected @endif>{{$user->username}}</option>
                    @endforeach
                </select>
                <br/>

                {!! Form::label("Departments", "Share with departments:") !!}
                <br/>

                <select name="Departments[]" multiple="multiple" class="form-control multiselect multiselect-primary">
                    @foreach($departments as $department)
                        <option value="{{$department->name}}" @if(in_array($department->name, $sharedDepartments)) selected @endif>{{$department->name}}</option>
                    @endforeach
                </select>
                <br/>

                {!! Form::label("Mass", "Mass sharing") !!}
                <br/>
                {!! Form::select("Mass",
                    ['None', 'Organizational', 'Public'],
                    $mass,
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