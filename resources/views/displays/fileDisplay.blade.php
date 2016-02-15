<div class="file-list">
    {{-- File header --}}
    @if((isset($userFiles) and count($userFiles)   > 0)     or
        (isset($deptFiles) and count($deptFiles)   > 0)     or
        (isset($orgFiles) and count($orgFiles)    > 0)     or
        (isset($shareFiles) and count($shareFiles)  > 0)     )

        {{-- User Owned Files --}}
        @if(isset($userFiles) and count($userFiles) > 0)
            <div class="file-header">
                My Files
            </div>
            @foreach($userFiles as $file)
                <div class="file-item-even" id="{{ $file->id }}">
                    <div class="file-name">{{ $file->filename }}</div>
                    <div class="file-owner">Me</div>
                    <div class="file-edited">
                        {{ date('F d, Y', strtotime($file->updated_at)) }}
                    </div>
                    <div class="file-actions">
                        <button class="btn btn-danger" data-toggle="modal" data-target="
                        @if($file->doc_type_id == 1)
                                #delFile
                        @else
                                #delAward
                    @endif
                                ">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </div>
                </div>
            @endforeach
        @endif

        {{-- User Owned Files --}}
        @if(isset($shareFiles) and count($shareFiles) > 0)
            <div class="file-header">
                Shared with me
            </div>
            @foreach($shareFiles as $file)
                <div class="file-item-even" id="{{ $file->id }}">
                    <div class="file-name">{{ $file->filename }}</div>
                    <div class="file-owner">{{ $file->user->fname . " " . $file->user->lname }}</div>
                    <div class="file-edited">{{ date('F d, Y', strtotime($file->updated_at))}}</div>
                </div>
            @endforeach
        @endif

        {{-- Files Shared With Department --}}
        @if(isset($deptFiles) and count($deptFiles) > 0)
            <div class="file-header">
                Shared with your department
            </div>
            @foreach($deptFiles as $file)
                <div class="file-item-even" id="{{ $file->id }}">
                    <div class="file-name">{{ $file->filename }}</div>
                    <div class="file-owner">{{ $file->user->fname . " " . $file->user->lname }}</div>
                    <div class="file-edited">{{ date('F d, Y', strtotime($file->updated_at)) }}</div>
                </div>
            @endforeach
        @endif

        {{-- Files Shared With Organization --}}
        @if(isset($orgFiles) and count($orgFiles) > 0)
            <div class="file-header">
                Shared with Angeles University Foundation
            </div>
            @foreach($orgFiles as $file)
                <div class="file-item-even" id="{{ $file->id }}">
                    <div class="file-name">{{ $file->filename }}</div>
                    <div class="file-owner">{{ $file->user->fname . " " . $file->user->lname }}</div>
                    <div class="file-edited">{{ date('F d, Y', strtotime($file->updated_at)) }}</div>
                </div>
            @endforeach
        @endif
    @else
        <div class="file-header">
            Nothing to show. Click on Upload New Document to get started.
        </div>
    @endif
</div>