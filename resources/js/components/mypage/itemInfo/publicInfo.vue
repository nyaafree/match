<template>
    <div>
        <div class="mypage-panel">
            <h2 class="mypage-title">これらのコメントは <a :href="'/match/items/' + receiveComment.id">{{receiveComment.title }}</a>に対してされたものです</h2>
            <public-comment :my-comment="myComment" v-for="myComment in receiveComments" :key="myComment.id" :user="user"
            @update="updateParent"/>
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
           receiveComment: this.itemInfo,
           showAllComments: false,
           arrayComments: [],
           latestMyComment: [],
        //    receiveComments: this.itemInfo.comments
        //    this.itemInfo.comments[(Object.keys(this.itemInfo.comments).length - 1)];
        //    comment:{
        //         content: this.myComment.comment,
        //         id: this.myComment.id,
        //    },
        //    edit: false,
        //    user_id: this.user.id,
        //    item_id: this.myComment.item.id
       }
    },
    methods:{
       editShow(){
           this.showAllComments = !this.showAllComments;
       },
       updateParent(){
           this.$emit('updateComments');
       }

    },
    created(){
        let self = this;
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
        receiveComments(){
            let self = this;
            if(this.showAllComments){
                return self.arrayComments;
            }else{
                return Array(self.arrayComments[(Object.keys(self.arrayComments).length - 1)]);
            }
        }
        // showOrHideSelf(){
        //     if(this.myComment.item)
        // }
    },
    components:{
        publicComment,
    }
}
</script>
