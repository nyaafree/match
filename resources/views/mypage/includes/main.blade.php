<section id="myMain">
    <div id="app">
        <mypage-area :my-items="{{ json_encode($myItems) }}" :apply-items="{{ json_encode($applyItems) }}"
         :my-comment-items="{{ json_encode($myCommentItems) }}" :user="{{ json_encode($user) }}"
         :my-messages="{{ json_encode($myMessages) }}"/>
    </div>
</section>
