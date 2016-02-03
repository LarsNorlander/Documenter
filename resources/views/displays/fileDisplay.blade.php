<div class="file-list">
    <!-- File header -->
    @if(count($userFiles) > 0 or count($deptFiles) > 0 or count($orgFiles) > 0 or count($shareFiles) > 0)
            <!-- User Owned Files -->
    @if(count($userFiles) > 0)
        <div class="file-header">
            My Files
        </div>
        @foreach($userFiles as $file)
                <!-- File item -->
        <div class="file-item-even" id="{{ $file->id }}">
            <div class="file-name">{{ $file->filename }}</div>
            <div class="file-owner">Me</div>
            <div class="file-edited">{{ date('F d, Y', strtotime($file->updated_at)) }}</div>
        </div>
        @endforeach
        @endif
                <!-- Files Shared With Department -->
        @if(count($deptFiles) > 0)
            <div class="file-header">
                {{ Auth::User()->user_dept->name }} Files
            </div>
            @foreach($deptFiles as $file)
                    <!-- File item -->
            <div class="file-item-even" id="{{ $file->id }}">
                <div class="file-name">{{ $file->filename }}</div>
                <div class="file-owner">{{ $file->user->fname . " " . $file->user->lname }}</div>
                <div class="file-edited">{{ date('F d, Y', strtotime($file->updated_at)) }}</div>
            </div>
            @endforeach
        @endif

        @if(count($orgFiles) > 0)
            <div class="file-header">
                Shared with Angeles University Foundation
            </div>
            @foreach($orgFiles as $file)
                    <!-- File item -->
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