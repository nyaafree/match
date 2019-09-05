<template>
    <div>
        <div class="mypage-panel">
            <h2 class="mypage-title">これらのコメントは <a :href="'/match/items/' + receiveItemInfo.id">{{receiveItemInfo.title }}</a>に対してされたものです</h2>
            <public-comment :my-comment="myComment" v-for="myComment in receiveMyComments" :key="myComment.id" :user="user"
            @update="updateMyComments(itemInfo.id)"/>
            <h3 class="mypage-latest">この案件に対する最新のコメントはコチラ↓</h3>
            <p class="c-panel__latest">
                {{latestComment.comment}}
            </p>
            <div>
                <button @click="editShow()" v-if="!showAllComments" class="show-comment-btn">この案件詳細掲示板につけた全てのコメントを表示する</button>
                <button @click="editShow()" v-else class="show-comment-btn">最新コメントのみを表示する</button>
            </div>
        </div>
    </div>
</template>

<script>
import publicComment from "./contents/publicComment";
export default {
    props:['itemInfo','user'],
    mounted(){
        // console.log(this.latestComment);
    },
    data(){
       return{
           receiveItemInfo: this.itemInfo,
           showAllComments: false,
           arrayComments: [],
           latestMyComment: [],

       }
    },
    methods:{
       editShow(){
           this.showAllComments = !this.showAllComments;
       },
       updateMyComments(id){
            let self = this;
            // 案件詳細画面につけられているコメント情報一覧を取得
            console.log('Updating Comments...');
            axios.post('api/item/comments/' + id).then((response) => {
                console.log(response.data);
                // 案件詳細画面につけられた全てのコメント情報を取得しているので、そこから自分のコメントのみをarrayCommentsに入れる
                if(response.data.length == 0){
                    self.$emit('update');
                }else{
                    response.data.forEach(element => {
                        if(element.user_id == self.user.id){
                            self.arrayComments.push(element);
                        }
                    });
                }

                 console.log(self.arrayComments);
                 // 案件詳細画面につけられている自分のコメントが0になったら案件情報をマイページから削除する為に親のメソッドを呼び出す
                    if(self.arrayComments.length == 0){
                       self.$emit('update');
                    }

            })
            .catch((error) => {
                console.log(error.error);
            })
        },

    },
    created(){
        let self = this;
        // 案件詳細画面につけられた全てのコメント情報を取得しているので、そこから自分のコメントのみをarrayCommentsに入れる
        this.itemInfo.comments.forEach(element => {
            if(element.user_id == self.user.id){
                self.arrayComments.push(element);
            }
        });
        console.log(this.itemInfo.comments);
        console.log(this.arrayComments[(Object.keys(self.arrayComments).length - 1)]);
        console.log(this.latestComment);
    },
    computed:{
        latestComment(){
            // 自分がコメントした案件詳細ページにつけられている最新コメントを取得
            return this.itemInfo.comments[(Object.keys(this.itemInfo.comments).length - 1)];
        },
        receiveMyComments(){
            let self = this;
            if(this.showAllComments){
                // 案件詳細画面に自分がつけた全てのコメントを表示
                return self.arrayComments;
            }else{
                // 案件詳細画面に自分がつけた最新コメントのみを表示
                return Array(self.arrayComments[(Object.keys(self.arrayComments).length - 1)]);
            }
        }
    },
    components:{
        publicComment,
    }
}
</script>
