<template>
    <div>
        <div  class="c-panel bg-yellow" >
            <h2 class="c-penel__title">このコメントは <a :href="'/match/items/' + receiveComment.item.id">{{receiveComment.item.title }}</a>に対してされたものです</h2>
            <div class="c-panel__textarea" v-if="!edit" @dblclick="editChange()">
                {{ comment.content }}
            </div>
            <textarea class="c-panel__textarea" v-model="comment.content" v-if="edit"  @dblclick="editChange()">

            </textarea>
            <h3>この案件に対する最新のコメントはコチラ↓</h3>
            <p class="c-panel__latest">
                {{latestComment.comment}}
            </p>
            <button class="btn btn-yellow" @click="editComment(receiveComment.id)">編集</button>
            <button class="btn btn-lightred" @click="deleteComment(receiveComment.id)">削除</button>
        </div>
    </div>
</template>

<script>
export default {
    props:['myComment','user'],
    mounted(){
        console.log(this.latestComment);
    },
    data(){
       return{
           receiveComment: this.myComment,
           comment:{
                content: this.myComment.comment,
                id: this.myComment.id,
           },

           edit: false,
           user_id: this.user.id,
       }
    },
    methods:{
        fetchComment(){
            // コメント情報を取得する
            console.log('Fetching Comment...');
            axios.post('api/fetch/comment/'+ this.comment.id).then((response) => {
            console.log(response.data);
            // 編集モードをオフにする
            this.edit = false;
            this.comment.content = response.data.comment;
        })
        .catch((error) => {
          console.log(error);
        })
        },
        editChange(){
            // 編集モードの切り替え
            this.edit = !this.edit;
        },
        editComment(id){
            // ko
            console.log('Updating Comment'+ id + '...');
            let self = this;
            let params = Object.assign({}, self.comment);
            axios.patch('api/comment/'+id,params)
            .then(function(response){
                // コメント編集が完了したら編集したコメントデータをDBから取得して編集後のコメントに更新する
                self.fetchComment();
                alert('コメント編集できました！');
       })
       .catch(function(error){
           console.log(error);
       });
        },
        deleteComment(id){
            // コメントを削除
            console.log('deleting Comments ...')
            let self = this;
            if(window.confirm('本当に登録案件を削除しますか？')){
                 axios.delete('api/comment/'+id)
                 .then(function(response){
                     // 親コンポーネントのメソッドを使ってコメント一覧を更新する
                     self.$emit('update',self.user_id);
                     alert('コメント削除完了しました！');
                 }).catch(function(error){
                     console.log(error);
                 });
            }else{
                // 案件パネル全体がaタグになっているので画面遷移を防ぐ
                event.preventDefault();
            }

        }
    },
    computed:{
        latestComment(){
            // 自分がコメントした案件詳細ページにつけられているphp artisan make:seeder UsersTableSeeder最新コメントを取得
            return this.myComment.item.comments[(Object.keys(this.myComment.item.comments).length - 1)];
        }
    }
}
</script>
