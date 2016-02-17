@extends('masterPage')

@section('body')
    <div class="container" style="padding-top: 50px; padding-bottom: 50px">
        <div class="jumbotron">
            <h1>Edit department</h1>
        </div>

        {!! Form::open(['url' => '/admin/edit/dept/' . $department->id, 'id' => 'addDeptForm']) !!}
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', $department->name, ['class'=>'form-control', 'required']) !!}
        <br/>
        <input name="submit" type="submit" value="Save" class="btn btn-primary">
        {!! Form::close() !!}
    </div>
@stop

@section('footer')
    <script>$("select").select2({dropdownCssClass: 'dropdown-inverse'});</script>
@stop