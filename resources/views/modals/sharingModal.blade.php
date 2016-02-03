<div class="modal fade" id="fileShare" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal Contents -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">File Sharing</h4>
            </div>
            <form action="/file/sharing" id="fileSharingForm" method="post" style="padding: 30px">
                {!! csrf_field() !!}
                Share with users
                <div class="tagsinput-primary">
                    <input name="users" type="text" class="tagsinput" data-role="tagsinput"
                           style="display:none;">
                </div>
                Mass Sharing
                <div>
                    <select name="massShare" class="form-control select select-primary select-block">
                        <option value="0">None</option>
                        <option value="1">Department</option>
                        <option value="2">Organization</option>
                        <option value="3">Public</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>