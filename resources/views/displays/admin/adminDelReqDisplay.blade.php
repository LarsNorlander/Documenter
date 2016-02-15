<div class="file-list">
    <div class="file-header">
        Delete Requests
    </div>
    @foreach($delReq as $file)
        @if($file->achievements->delete_pending == true)
            <div class="file-item-even" id="{{ $file->id }}">
                <div class="file-name">{{ $file->filename }}</div>
                <div class="file-owner">Me</div>
                <div class="file-edited">
                    {{ date('F d, Y', strtotime($file->updated_at)) }}
                </div>
            </div>
        @endif
    @endforeach
</div>