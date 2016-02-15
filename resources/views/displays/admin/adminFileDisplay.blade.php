<div class="file-list">
    {{-- File header --}}
    @foreach($allFiles as $file)
        {{-- File item --}}
        <div class="file-item-even" id="{{ $file->id }}">
            <div class="file-name">{{ $file->filename }}</div>
            <div class="file-owner">{{ $file->user->fname . " " . $file->user->lname }}</div>
            <div class="file-edited">{{ date('F d, Y', strtotime($file->updated_at)) }}</div>
        </div>
    @endforeach
</div>
