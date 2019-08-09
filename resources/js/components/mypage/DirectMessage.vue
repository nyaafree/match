<template>
    <div>
         <div  class="c-panel bg-purple" >
           <h2 class="c-penel__title">このコメントは <a :href="'items/' + receiveMessage.board.item.id">{{ receiveMessage.board.item.title }}</a>
           への<a :href="'/match/board/' + receiveMessage.board.id">応募掲示板{{ receiveMessage.board.id }}</a>に対してされたものです</h2>
           <div class="c-panel__textarea" v-if="!edit" @dblclick="editChange()">
               {{ message.rmessage }}
           </div>
           <textarea class="c-panel__textarea" v-model="message.rmessage" v-if="edit"  @dblclick="editChange()">

           </textarea>
           <button class="btn btn-yellow" @click="editMessage(receiveMessage.id)">編集</button>
           <button class="btn btn-lightred" @click="deleteMessage(receiveMessage.id)">削除</button>
         </div>
    </div>
</template>

<script>
export default {
    props:['myMessage','user'],
    mounted(){
        // console.log(this.myComment);
    //    console.log(this.user.id);
    },
    data(){
       return{
           receiveMessage: this.myMessage,
           message:{
                rmessage: this.myMessage.message,
                id: this.myMessage.id,
           },

           edit: false,
           user_id: this.user.id,
       }
    },
    methods:{
        fetchMessage(){
            console.log('Fetching Message...');
            axios.post('api/message/update/'+ this.message.id).then((response) => {
            console.log(response.data);
            this.edit = false;
            this.message.rmessage = response.data.message;
        })
        .catch((error) => {
          console.log(error);
        })
        },
        editChange(){
            this.edit = !this.edit;
        },
        editMessage(id){
            console.log('Updating Message'+ id + '...');
            let self = this;
            let params = Object.assign({}, self.message);
            axios.patch('api/message/'+id,params)
            .then(function(response){
                self.fetchMessage();
                alert('メッセージ編集できました！');
       })
       .catch(function(error){
           console.log(error);
       });
        },
        deleteMessage(id){
            let self = this;
            if(window.confirm('本当にこのメッセージを削除しますか？')){
                 axios.delete('api/message/'+id)
                 .then(function(response){
                    self.$emit('update',self.user_id);
                     alert('メッセージ削除完了しました！');
                 }).catch(function(error){
                     console.log(error);
                 });
            }else{
                event.preventDefault();
            }

        }
    }
}
</script>
