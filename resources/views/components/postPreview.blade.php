<section class="postFeed">
    <div class="postPreviewList">
        @forelse ($previous as $item)
            <img src={{$item->thumbnail}} alt="thumbnail">
        @empty
            <div class="postPreviewEmpty">NULL</div>
        @endforelse
            <img src={{$post->thumbnail}} alt="thumbnail">
        @forelse ($next as $item)
            <img src={{$item->thumbnail}} alt="thumbnail">
        @empty
            <div class="postPreviewEmpty">NULL</div>
        @endforelse
    </div>
</section>