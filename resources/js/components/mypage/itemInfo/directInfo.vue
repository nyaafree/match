<template>
    <div>
        <div class="mypage-panel">
            <h2 class="mypage-title">これらのメッセージは <a :href="'/match/items/' + boardInfo.item.id">{{ boardInfo.item.title }}</a>
            への<a :href="'/match/board/' + boardInfo.id">応募掲示板{{ boardInfo.id }}</a>に対してされたものです</h2>
           <direct-message  :my-message="myMessage" v-for="myMessage in receiveMyMessages" :key="myMessage.id" :user="user" @update="updateMyMessages(receiveBoard.id)"/>
            <div>
                <button @click="editShow()" v-if="!showAllMessages" class="show-comment-btn">この掲示板でやり取りした全てのメッセージを表示する</button>
                <button @click="editShow()" v-else class="show-comment-btn">最新メッセージのみを表示する</button>
            </div>
        </div>
    </div>
</template>

<script>
import directMessage from "./contents/directMessage";
export default {
    props:['boardInfo','user'],
    mounted(){
        // console.log(this.latestComment);
    },
    data(){
       return{
           receiveBoard: this.boardInfo,
           showAllMessages: false,
           arrayMessages: [],
       }
    },
    methods:{
       editShow(){
           this.showAllMessages = !this.showAllMessages;
       },
       updateMyMessages(id){
            let self = this;
            // 掲示板に投稿されているダイレクトメッセージ一覧情報を更新
            console.log('Updating Messages...');
            axios.post('api/board/messages/' + id).then((response) => {
                console.log(response.data);
                if(response.data.length == 0){
                    self.$emit('update');
                }else{
                    // arrayMessagesをリセットして空にする
                    self.arrayMessages = [];
                    // 掲示板に投稿された全てのダイレクトメッセージを取得しているのでそこから自分が投稿したもののみ配列arrayMessagesに入れる
                    response.data.forEach(element => {
                        if(element.user_id == self.user.id){
                            self.arrayMessages.push(element);
                        }
                    });

                    console.log(self.arrayMessages);
                    // 掲示板につけられている自分のメッセージが0になったら掲示板情報を削除する為に親のメソッドを呼び出す
                    if(self.arrayMessages.length == 0){
                        self.$emit('update');
                    }
                }

               

            })
            .catch((error) => {
                console.log(error.error);
            })
        },
    },
    created(){
        let self = this;
        // 掲示板に投稿された全てのダイレクトメッセージを取得しているのでそこから自分が投稿したもののみ配列arrayMessagesに入れる
        this.boardInfo.messages.forEach(element => {
            if(element.user_id == self.user.id){
                self.arrayMessages.push(element);
            }
        });
        console.log(this.boardInfo.messages);
        console.log(this.arrayMessages[(Object.keys(self.arrayMessages).length - 1)]);
        console.log(this.latestMessage);
    },
    computed:{
        latestMessage(){
            // 自分がコメントした案件詳細ページにつけられている最新コメントを取得
            return this.boardInfo.messages[(Object.keys(this.boardInfo.messages).length - 1)];
        },
        // 掲示板で自分がやり取りしたダイレクトメッセージを最新のものだけ表示するか、それとも全て表示するかを切り替えるメソッド
        receiveMyMessages(){
            let self = this;
            if(this.showAllMessages){
                // 自分がやり取りした全てのダイレクトメッセージを表示
                return self.arrayMessages;
            }else{
                // 自分がやり取りした最新のダイレクトメッセージのみ表示
                return Array(self.arrayMessages[(Object.keys(self.arrayMessages).length - 1)]);
            }
        }
    },
    components:{
        directMessage,
    }
}
</script>
