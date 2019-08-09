<template>
    <div>
        <!-- <h1 class="index-title half-width" id="apply">投稿コメント一覧</h1>
         <div  class="c-panel bg-yellow" >
        <h2 class="c-penel__title">このコメントは <a :href="'items/' + comment.item.id">{{comment.item.title }}</a>に対してされたものです</h2>
        <texrarea class="c-panel__detail" v-model="rcomment">

        </texrarea>
       </div> -->
        <!-- <h1 class="index-title half-width" id="apply">投稿コメント一覧</h1> -->
         <div  class="c-panel bg-yellow" >
           <h2 class="c-penel__title">このコメントは <a :href="'/match/items/' + receiveComment.item.id">{{receiveComment.item.title }}</a>に対してされたものです</h2>
           <div class="c-panel__textarea" v-if="!edit" @dblclick="editChange()">
               {{ comment.rcomment }}
           </div>
           <textarea class="c-panel__textarea" v-model="comment.rcomment" v-if="edit"  @dblclick="editChange()">

           </textarea>
           <!-- <h2 c-panel__title>{{receiveComment.latestComment.comment}}</h2> -->
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
        // console.log(this.myComment);
    //    console.log(this.user.id);
    // console.log(this.myComment.item.comments);
    // console.log(Object.keys(this.myComment.item.comments).length);
    console.log(this.latestComment);
    // console.log(this.myComment);
    // console.log(this.receiveComment);
    },
    data(){
       return{
           receiveComment: this.myComment,
           comment:{
                rcomment: this.myComment.comment,
                id: this.myComment.id,
           },

           edit: false,
           user_id: this.user.id,
       }
    },
    methods:{
        fetchCommentList(){
            console.log('Fetching Comments...');
            axios.post('api/fetch/'+ this.comment.id).then((response) => {
            console.log(response.data);
            this.edit = false;
            this.comment.rcomment = response.data.comment;
        })
        .catch((error) => {
          console.log(error);
        })
        },
        editChange(){
            this.edit = !this.edit;
        },
        editComment(id){
            console.log('Updating Comment'+ id + '...');
            let self = this;
            let params = Object.assign({}, self.comment);
            axios.patch('api/comment/'+id,params)
            .then(function(response){
                self.fetchCommentList();
                alert('コメント編集できました！');
       })
       .catch(function(error){
           console.log(error);
       });
        },
        deleteComment(id){
            let self = this;
            if(window.confirm('本当に登録案件を削除しますか？')){
                 axios.delete('api/comment/'+id)
                 .then(function(response){
                    self.$emit('update',self.user_id);
                     alert('コメント削除完了しました！');
                 }).catch(function(error){
                     console.log(error);
                 });
            }else{
                event.preventDefault();
            }

        }
    },
    computed:{
        latestComment(){
            return this.myComment.item.comments[(Object.keys(this.myComment.item.comments).length - 1)];
        }
    }
}
</script>
