<div class="file-list">
    <div class="file-header">Departments</div>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addDept"
            style="margin-left: 10px; margin-bottom:20px">Add Department
    </button>
    @foreach($allDepts as $file)
        {{-- File item --}}
        <div class="file-item-even" id="{{ $file->id }}">
            <div class="file-name" style="margin-left:10px; width:90%">{{ $file->name }}</div>
            <div class="btn-group" style="text-align:left; width:10%">
                <a href="#" class="btn btn-primary" id="editButton"
                   data-toggle="modal" data-target="#fileShare">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="/admin/del/dept/{{$file->id}}" class="btn btn-danger" id="deleteButton">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </div>
        </div>
    @endforeach
</div>


<div class="modal fade" id="addDept" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        {{-- Modal Contents --}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload your documents</h4>
            </div>
            <form action="/admin/add/dept" method="post" style="margin:20px" id="addDeptForm">
                <label>College name:</label>
                <input name="collegeName" type="text" class="form-control">
                {!! csrf_field() !!} <br/>
                <input name="submit" type="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>