<template>
    <div>
        <my-items :my-items="myItems"/> <!-- 自分が投稿した案件情報のコンポーネント -->
        <apply-items :apply-items="applyItems"/> <!-- 自分が応募した案件情報のコンポーネント -->
        <h1 class="index-title" id="public">投稿コメント一覧</h1>
        <!-- 案件詳細画面において自分がしたパブリックメッセージを表示　-->
        <public-messages :my-comment="myComment" v-for="myComment in receiveComments" :key="myComment.id" :user="user"
        @update="updateMyItems"/>
        <h1 class="index-title" id="direct">ダイレクトメッセージ一覧</h1>
        <!-- 案件応募完了した後の掲示板においてやり取りしたダイレクトメッセージを表示　-->
        <direct-messages :my-message="myMessage" v-for="myMessage in receiveMessages" :user="user"
        @update="updateMyMessages"/>
    </div>
</template>

<script>
import MyItems from "./mypage/MyItems";
import ApplyItems from "./mypage/ApplyItems";
import PublicMessages from "./mypage/PublicMessages";
import DirectMessage from "./mypage/DirectMessage";
export default {
    props:['myItems','applyItems','myComments','user','myMessages'],
    data(){
        return{
           receiveComments: this.myComments, // propsとして受け取った値をdata属性として登録
           receiveMessages: this.myMessages,
        }
    },
    components:{
        MyItems,
        ApplyItems,
        PublicMessages,
        DirectMessage,
    },
    methods:{
        updateMyItems(id){
            // マイページに表示されているパブリックメッセージ一覧をaxiosで更新
            console.log('Updating Comments...');
            axios.post('api/all/comments/' + id).then((response) => {
                console.log(response.data);
                this.receiveComments = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
        },
        updateMyMessages(id){
            // マイページに表示されているダイレクトメッセージ一覧をaxiosで更新
            axios.post('api/all/messages/' + id).then((response) => {
                console.log(response.data);
                this.receiveMessages = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
        }
    }


}
</script>
