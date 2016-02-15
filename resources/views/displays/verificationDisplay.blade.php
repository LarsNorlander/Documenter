<div class="file-list">
    @if(isset($userFiles) and count($userFiles)   > 0)
        @if(isset($userFiles) and count($userFiles) > 0)
            <div class="file-header">
                Verification
            </div>
            <?php $x = 0 ?>
            @foreach($userFiles as $file)
                @if($file->achievements->approved == false)
                    <?php $x++ ?>
                    <div class="file-item-even" id="{{ $file->id }}">
                        <div class="file-name">{{ $file->filename }}</div>
                        <div class="file-owner">Me</div>
                        <div class="file-edited">
                            {{ date('F d, Y', strtotime($file->updated_at)) }}
                        </div>
                        <div class="file-actions">
                            <a href="/hr/approve/{{$file->id}}" class="btn btn-info">
                                <span class="glyphicon glyphicon-ok"></span>
                            </a>
                            <a href="/hr/decline/{{$file->id}}" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    @endif
    @if($x == 0)
        There is nothing to show.
    @endif
</div>