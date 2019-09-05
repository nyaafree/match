<template>
    <div>
        <my-items :my-items="myItems"/> <!-- 自分が投稿した案件情報のコンポーネント -->
        <apply-items :apply-items="applyItems"/> <!-- 自分が応募した案件情報のコンポーネント -->
        <h1 class="index-title" id="public">投稿コメント一覧</h1>
        <!-- ログインユーザーがコメントした案件情報一覧を取得 -->
        <public-info :item-info="itemInfo" v-for="(itemInfo) in receiveCommentItems" :key="itemInfo.id" :user="user"
        @update="updatePublicItems(user.id)"/>
        <h1 class="index-title" id="direct">ダイレクトメッセージ一覧</h1>
        <!-- ログインユーザーがダイレクトメッセージをやり取りした掲示板情報一覧を取得 -->
        <direct-info :board-info="boardInfo" v-for="boardInfo in receiveBoards" :key="boardInfo.id" :user="user"
        @update="updateDirectItems(user.id)"/>
    </div>
</template>

<script>
import MyItems from "./mypage/MyItems";
import ApplyItems from "./mypage/ApplyItems";
import PublicMessages from "./mypage/PublicMessages";
import DirectMessage from "./mypage/DirectMessage";
import publicInfo from "./mypage/itemInfo/publicInfo";
export default {
    props:['myItems','applyItems','myCommentItems','user','myMessages','myMessageBoards'],
    data(){
        return{
           receiveCommentItems: this.myCommentItems, // propsとして受け取った値をdata属性として登録
           receiveMessages: this.myMessages,
           receiveBoards: this.myMessageBoards,
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
        updatePublicItems(id){
          axios.post('api/all/public/items/'+ id).then((response) => {
              this.receiveCommentItems = response.data;
          })
          .catch((error) => {
              console.log(error.response.data);
          })
        },
        updateDirectItems(id){
            axios.post('api/all/direct/items/' + id).then((response) => {
                this.receiveBoards = response.data;
            })
            .catch((error) => {
                console.log(error.response.data);
            })
        }

    }


}
</script>
