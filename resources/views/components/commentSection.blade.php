<section id="commentSection">
    <form id="commentForm" action="/comment" method="post">
        <h3>write comment</h3>
        <textarea name="" id="commentFormText" rows="8">
        </textarea>
        <input type="submit" value="SEND">
    </form>
    @forelse ($comments as $comment)
        <div class="commentItem">
            Anon
            <div class="commentBody">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus voluptate quidem ipsa aliquid quis rem ea iste. Et aut alias necessitatibus eaque quidem sunt id magnam! Aliquam adipisci sequi reprehenderit?
            </div>
        </div>
    @empty
        <div class="noCommentItem">
            NO COMMENTS YET :(
        </div>
    @endforelse
</section>