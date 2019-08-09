<template>
    <div>
        <my-items :my-items="myItems"/>
        <apply-items :apply-items="applyItems"/>
        <h1 class="index-title" id="public">投稿コメント一覧</h1>
        <public-messages :my-comment="myComment" v-for="myComment in receiveComments" :key="myComment.id" :user="user"
        @update="updateMyItems"/>
        <h1 class="index-title" id="direct">ダイレクトメッセージ一覧</h1>
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
           receiveComments: this.myComments,
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
            console.log('Updating Comments...');
            axios.post('api/all/comments' + id).then((response) => {
                console.log(response.data);
                this.receiveComments = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
        },
        updateMyMessages(id){
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
