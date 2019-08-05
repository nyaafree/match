<section id="myMain">
    <div id="app">
        <mypage-area :my-items="{{ json_encode($myItems) }}" :apply-items="{{ json_encode($applyItems) }}"
         :my-comments="{{ json_encode($myComments) }}" :user="{{ json_encode($user) }}"
         :my-messages="{{ json_encode($myMessages) }}"/>
    </div>
</section>
