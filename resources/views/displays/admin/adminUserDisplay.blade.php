<div class="file-list">
    <div class="file-header">Users</div>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addUser"
            style="margin-left: 10px; margin-bottom:20px">Add User
    </button>
    @foreach($allUsers as $user)
        {{-- File item --}}
        @unless($user->username == auth::user()->username)
            <div class="file-item-even" id="{{ $user->id }}">
                <div class="file-name" style="margin-left:10px; width:30%">
                    {{$user->fname . " " . $user->lname . " "}}({{ $user->username }})
                </div>
                <div class="file-name" style="width:30%">
                    {{$user->user_dept->name}}
                </div>
                <div class="file-name" style="width:30%">
                    {{$user->user_type->name}}
                </div>

                <div class="file-name" style="width:30%">
                    @if($user->user_status_id == 1)
                        Active
                    @else
                        Deactivated
                    @endif
                </div>

                <div class="btn-group" style="text-align:left; width:10%">
                    <a href="/admin/edit/user/{{$user->id}}" class="btn btn-primary" id="editButton">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>

                    <a href="/admin/user/lock/{{$user->id}}" class="btn btn-default" id="deleteButton">
                        <span class="glyphicon glyphicon-lock"></span>
                    </a>

                </div>
            </div>
        @endunless
    @endforeach
</div>

<div class="modal fade" id="addUser" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        {{-- Modal Contents --}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add a user</h4>
            </div>
            {!! Form::open(['url' => '/admin/add/user', 'id' => 'addDeptForm']) !!}
            <div class="modal-body">
                {!! Form::label('fname', 'First name') !!}
                {!! Form::text('fname', null, ['class'=>'form-control', 'required']) !!}
                {!! Form::label('lname', 'Last name') !!}
                {!! Form::text('lname', null, ['class'=>'form-control', 'required']) !!}
                {!! Form::label('username', 'Username') !!}
                {!! Form::text('username', null, ['class'=>'form-control', 'required']) !!}
                {!! Form::label('password', 'Password') !!}
                <input name="password" id="password" type="password" class="form-control" required>
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', null, ['class'=>'form-control', 'required']) !!}
                {!! Form::label("department", "Department:") !!}
                <select name="department" class="select-primary select-block">
                    @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
                {!! Form::label("userType", "User Type:") !!}
                <select name="userType" class="select-primary select-block">
                    @foreach($userTypes as $userType)
                        <option value="{{$userType->id}}">{{$userType->name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="modal-footer">
                <input name="submit" type="submit" class="btn btn-primary">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>