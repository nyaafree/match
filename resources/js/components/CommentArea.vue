<template>
    <div>
        <div class="c-comment" v-if="showComments">
            <div v-for="comment in receiveComments" :key="comment.id">
                <!-- 案件投稿者のコメント -->
                <proposer-comments  :prp-comment="comment" v-if="comment.user_id == receiveItem.user_id"/>
                <!-- 案件に質問や疑問点がある人のコメント -->
                <applicant-comments :apl-comment="comment"  v-else/>
            </div>
        </div>

        <form action="" @submit.prevent=" createComment() ">
            <div class="p-item__container1">
                <textarea name="comment" cols="30" rows="8" class="p-item__input" v-model="input.comment">

                </textarea>
                <button type="submit" class="btn btn-lightblue">コメントする</button>
            </div>
        </form>
        <div class="error-area" v-if="errorMessages !== ''">
             <div v-for="error in errorMessages.comment" :key="error.id" class="error-message" role="alert">{{ error }}</div>
         </div>
    </div>
</template>

<script>
import ApplicantComments from "./comments/ApplicantComments";
import ProposerComments from "./comments/ProposerComments";

export default {
    props:['comments','item','user'],
    data(){
        return{
            // JSON.parse()でpropsとして渡ってきた文字列をJSON形式に変換
            receiveComments: JSON.parse(this.comments),
            receiveItem: JSON.parse(this.item),


            input:{
                id: JSON.parse(this.item).id,
                comment:'',
                user_id: JSON.parse(this.user).id
            },
            showComments: false,
            errorMessages: '',
        }
    },
    create(){

    },
    mounted(){
        // マウントされた時にしかこの処理ができないのコメント投稿した場合反映されない
        this.showComments();

    },
    components:{
        ApplicantComments,
        ProposerComments,
    },
    watch:{
      receiveComments: function(){

      }
    },
    computed:{
    //    applyComments: function(){
    //         const self = this;
    //         let arr = self.receiveComments;
    //         let arr2 = self.receiveItem;
    //         let a = [];
    //         for (let comment of arr) {
    //             if(comment.user_id != arr2.user_id ){
    //                a.push(comment);
    //             }
    //         }
    //         return a;
    //    },
    //    proposeComments: function(){
    //        const self = this;
    //         let arr = self.receiveComments;
    //         let arr2 = self.receiveItem;
    //         let b = [];
    //         for (let comment of arr) {
    //             if(comment.user_id == arr2.user_id ){
    //                b.push(comment);
    //             }
    //         }
    //         return b;
    //    }

    },
    methods:{
        fetchCommentList: function(){
            // 案件詳細画面につけられたコメント一覧を取得
            const self = this;
             console.log('Fetching Comments...');
             axios.get('../api/item/'+ this.input.id +'/comments').then((response) => {
                console.log(response.data);
                self.receiveComments = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
        },
        createComment: function(){
            // コメントを投稿する
            console.log('Creating Comment...');
            let self = this;
            let params = Object.assign({}, self.input);
            console.log(params);
            axios.post('../api/create/comment',params
            )
            .then(function(response){
                // v-modelでフォームと紐づけられたself.input.commentを空にしておかないとコメント投稿後も投稿したコメント内容が入力フォームに表示されてしまう
                self.input.comment = '';
                self.receiveComments = response.data;
                // コメント投稿後に案件詳細画面につけられたコメント一覧を更新する
                self.fetchCommentList();
                // コメントが１件でも投稿されていれば表示する
                self.showComments();
            })
            .catch(function(error){
                console.log(error.response.data.errors);
                console.log(error.response.data.errors.comment);
                // data属性のerrorMessagesにバリデーションエラーメッセージを格納する
                self.errorMessages = error.response.data.errors;
           });
        },
        showComments: function(){
           if(Object.keys(this.receiveComments).length != 0){
                // 案件詳細ページにコメントが一つでもつけられていればコメント一覧を表示。
                // コメントが一つもなければ「コメントはまだ投稿されていません。」と表示
                this.showComments = true;
           }
        }
    }
}
</script>
