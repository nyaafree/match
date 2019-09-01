<template>
    <div>
        <my-items :my-items="myItems"/> <!-- 自分が投稿した案件情報のコンポーネント -->
        <apply-items :apply-items="applyItems"/> <!-- 自分が応募した案件情報のコンポーネント -->
        <h1 class="index-title" id="public">投稿コメント一覧</h1>
        <!-- 案件詳細画面において自分がしたパブリックメッセージを表示 -->
        <!-- <public-messages :my-comment="myComment" v-for="myComment in receiveComments" :key="myComment.id" :user="user"
        @update="updateMyComments"/> -->
        <public-info :item-info="itemInfo" v-for="(itemInfo) in receiveCommentItems" :key="itemInfo.id" :user="user" @updateComments="updateMyComments(user.id)"/>
        <h1 class="index-title" id="direct">ダイレクトメッセージ一覧</h1>
        <!-- 案件応募完了した後の掲示板においてやり取りしたダイレクトメッセージを表示 -->
        <direct-messages :my-message="myMessage" v-for="(myMessage,index) in receiveMessages" :key="index" :user="user"
        @update="updateMyMessages"/>
    </div>
</template>

<script>
import MyItems from "./mypage/MyItems";
import ApplyItems from "./mypage/ApplyItems";
import PublicMessages from "./mypage/PublicMessages";
import DirectMessage from "./mypage/DirectMessage";
import publicInfo from "./mypage/itemInfo/publicInfo";
export default {
    props:['myItems','applyItems','myCommentItems','user','myMessages'],
    data(){
        return{
           receiveCommentItems: this.myCommentItems, // propsとして受け取った値をdata属性として登録
           receiveMessages: this.myMessages,
           publicMessageItemNumbers: [],
        //    directMessageItemNumbers: [],
        }
    },
    components:{
        MyItems,
        ApplyItems,
        PublicMessages,
        DirectMessage,
        publicInfo,
    },
    mounted(){
    //   let self = this;
    //   console.log(this.myComments);
    //   this.myComments.forEach(element => {
    //     console.log(element);
    //     Object.keys(element).forEach( key => {
    //         if(key == 'item_id'){
    //             if(!self.publicMessageItemNumbers.includes(element.item_id)){
    //                 self.publicMessageItemNumbers.push(element.item_id);
    //             }
    //         }
    //     })
    //   });
    //   console.log(this.publicMessageItemNumbers);
    },
    methods:{
        updateMyComments(id){
            // マイページに表示されているパブリックメッセージ一覧をaxiosで更新
            console.log('Updating Comments...');
            axios.post('api/fetch/public/items/' + id).then((response) => {
                console.log(response.data);
                this.receiveCommentItems = response.data;
            })
            .catch((error) => {
                console.log(error.error);
            })
        },
        updateMyMessages(id){
            // マイページに表示されているダイレクトメッセージ一覧をaxiosで更新
            axios.post('api/all/messages/' + id).then((response) => {
                console.log(response.data);
                this.receiveMessages = response.data;
            })
            .catch((error) => {
                console.log(error.error);
            })
        },

    }


}
</script>
