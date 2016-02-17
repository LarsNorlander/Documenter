@extends('masterPage')

@section('body')
    <div class="container" style="padding-top: 50px; padding-bottom: 50px">
        <div class="jumbotron">
            <h1>Edit user</h1>
        </div>

        {!! Form::open(['url' => '/admin/edit/user/' . $user->id, 'id' => 'addDeptForm']) !!}
        {!! Form::label('fname', 'First name') !!}
        {!! Form::text('fname', $user->fname, ['class'=>'form-control', 'required']) !!}
        {!! Form::label('lname', 'Last name') !!}
        {!! Form::text('lname', $user->lname, ['class'=>'form-control', 'required']) !!}
        {!! Form::label('username', 'Username') !!}
        {!! Form::text('username', $user->username, ['class'=>'form-control', 'required']) !!}
        {!! Form::label('password', 'Password (Enter value to change. Leave blank to keep the same)') !!}
        <input name="password" id="password" type="password" class="form-control">
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email', $user->email, ['class'=>'form-control', 'required']) !!}
        {!! Form::label("department", "Department:") !!} <br/>
        <select name="department" class="form-control select select-primary select-block">
            @foreach($departments as $department)
                <option value="{{$department->id}}" @if($department->id == $user->user_dept_id) selected @endif >{{$department->name}}</option>
            @endforeach
        </select><br/>
        {!! Form::label("userType", "User Type:") !!}<br/>
        <select name="userType" class="form-control select select-primary select-block">
            @foreach($userTypes as $userType)
                <option value="{{$userType->id}}" @if($userType->id == $user->user_type_id) selected @endif >{{$userType->name}}</option>
            @endforeach
        </select><br/><br/>
        <input name="submit" type="submit" value="Save" class="btn btn-primary">
        {!! Form::close() !!}
    </div>
@stop

@section('footer')
<script>$("select").select2({dropdownCssClass: 'dropdown-inverse'});</script>
@stop