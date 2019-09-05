<template>
    <div>
         <div  class="c-panel bg-purple" >
           <h4 class="c-panel__notice">※ 下のメッセージエリアをダブルクリックするとメッセージ編集フォームに切り替える事が出来ます</h4>
           <!-- コメント表示領域をダブルクリックすることで表示用のdivタグと編集用のtextareaタグに切り替えることができる -->
           <div class="c-panel__textarea" v-if="!edit" @dblclick="editChange()">
               {{ message.content }}
           </div>
           <textarea class="c-panel__textarea" v-model="message.content" v-if="edit"  @dblclick="editChange()">

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

    },
    data(){
       return{
           receiveMessage: this.myMessage,
           message:{
                content: this.myMessage.message,
                id: this.myMessage.id,
           },

           edit: false,
           user_id: this.user.id,
       }
    },
    methods:{
        fetchMessage(){
            // ダイレクトメッセージを更新
            console.log('Fetching Message...');
            axios.post('api/message/update/'+ this.message.id).then((response) => {
            console.log(response.data);
            this.edit = false;
            this.message.content = response.data.message;
        })
        .catch((error) => {
           console.log(error);
        })
        },
        // メッセージの編集フォームの切り替え
        editChange(){
            this.edit = !this.edit;
        },
        editMessage(id){
            console.log('Updating Message'+ id + '...');
            let self = this;
            let params = Object.assign({}, self.message);
            axios.patch('api/message/'+id,params)
            .then(function(response){
                // 編集したダイレクトメッセージデータを更新
                self.fetchMessage();
                alert('メッセージ編集できました！');
       })
       .catch(function(error){
           console.log(error);
       });
        },
        deleteMessage(id){
            let self = this;
            console.log('deleting directMessages ...');
            if(window.confirm('本当にこのメッセージを削除しますか？')){
                axios.delete('api/message/'+id)
                .then(function(response){
                    // ダイレクトメッセージ削除が完了したら削除したメッセージを画面から消したいので、親コンポーネントのダイレクトメッセージ一覧を取得するメソッドを実行
                    self.$emit('update');
                    alert('メッセージ削除完了しました！');
                }).catch(function(error){
                    console.log(error);
                });
            }else{
                // メッセージ削除の確認ダイアログでキャンセルを選択した場合には削除処理を止める
                event.preventDefault();
            }

        }
    }
}
</script>
