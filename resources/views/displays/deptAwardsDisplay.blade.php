<div class="file-list">
    <div class="file-header">
        Department Awards
    </div>
    @foreach($deptAwards as $award)
        @if($award->user->user_dept_id == Auth::User()->user_dept_id)
            <div class="file-item-even" id="{{ $award->id }}">
                <div class="file-name">{{ $award->filename }}</div>
                <div class="file-owner">{{ $award->user->fname . " " . $award->user->lname }}</div>
                <div class="file-edited">
                    {{ date('F d, Y', strtotime($award->updated_at)) }}
                </div>
            </div>
        @endif
    @endforeach
</div>
