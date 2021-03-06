<div class="file-list">

    <div class="file-list-head">
        <div class="file-name">Name</div>
        <div class="file-owner">Owner</div>
        <div class="file-edited">Version</div>
        <div class="file-edited">Last Modified</div>
        <div class="file-actions"></div>
        </div>
    {{-- File header --}}
    @if((isset($userFiles) and count($userFiles)   > 0)     or
        (isset($deptFiles) and count($deptFiles)   > 0)     or
        (isset($editableFiles) and count($editableFiles)   > 0)     or
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
                    <div class="file-pub">{{ $file->public_version }}</div>
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

        {{-- User Shared Files --}}
        @if(isset($editableFiles) and count($editableFiles) > 0)
            <div class="file-header">
                Shared with me (edit)
            </div>
            @foreach($editableFiles as $file)
                <div class="file-item-even editable" id="{{ $file->id }}">
                    <div class="file-name">{{ $file->filename }}</div>
                    <div class="file-owner">{{ $file->user->fname . " " . $file->user->lname }}</div>
                    <div class="file-edited">{{ date('F d, Y', strtotime($file->updated_at))}}</div>
                </div>
            @endforeach
        @endif

        {{-- User Shared Files --}}
        @if(isset($shareFiles) and count($shareFiles) > 0)
            <div class="file-header">
                Shared with me (view)
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