<!-- Upload Modal -->
<div class="modal fade" id="uploadFile" tabindex="-1" role="dialog">
    <div class="modal-dialog">

        <!-- Modal Contents -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload your documents</h4>
            </div>
            <form action="/upload"
                  class="dropzone"
                  id="my-awesome-dropzone" method="post">
                {!! csrf_field() !!}
            </form>
        </div>
    </div>
</div>