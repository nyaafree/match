<template>
    <div>
        <div class="c-comment" v-if="showComments">
            <!-- <applicant-comments :aplComments="applyComments"/>
            <proposer-comments  :prpComments="proposeComments"/> -->
            <!-- <applicant-comments :apl-comment="aplComment" v-for="aplComment in applyComments" :key="aplComment.id"/>
            <proposer-comments  :prp-comment="prpComment" v-for="prpComment in proposeComments" :key="prpComment.id"/> -->
            <div v-for="comment in receiveComments" :key="comment.id">
                <!-- <applicant-comments :apl-comment="comment" v-if="comment.user_id != item.user_id"/>
                <proposer-comments  :prp-comment="comment" v-else/> -->
                  <proposer-comments  :prp-comment="comment" v-if="comment.user_id == receiveItem.user_id"/>

                  <applicant-comments :apl-comment="comment" v-else/>
            </div>
        </div>

        <form action="" @submit.prevent=" createComment() ">
            <!-- <input type="hidden" name="_token" :value="csrf"> -->
            <div class="p-item__container1">
                <textarea name="comment" cols="30" rows="8" class="p-item__input" v-model="input.comment">

                </textarea>

                <button type="submit" class="btn btn-lightblue">コメントする</button>
            </div>

        </form>
        <div class="error-area" v-if="errorMessages !== ''">
            <div class="error-show">
                <strong>エラー発生！フォームの入力内容に誤りがあります。</strong>
            </div>
             <div v-for="error in errorMessages.comment" :key="error.id" class="error-message" role="alert">{{ error }}</div>
         </div>
    </div>
</template>

<script>
import ApplicantComments from "./comments/ApplicantComments";
import ProposerComments from "./comments/ProposerComments";
// import allComments from "./comments/AllComments";
// import SubmitComment from "./comments/SubmitComment";

export default {
    props:['comments','item','user'],
    data(){
        return{
            receiveComments: JSON.parse(this.comments),
            receiveItem: JSON.parse(this.item),
            // proposeComments:[],
            // applyComments: [],

            input:{
                id: JSON.parse(this.item).id,
                comment:'',
                user_id: JSON.parse(this.user).id
            },
            showComments: false,
            errorMessages: '',
            // csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    create(){

    },
    mounted(){
       if(Object.keys(this.receiveComments).length != 0){
            this.showComments = true;
        }
        // this.input.id = this.receiveItem.id;

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
       applyComments: function(){
            const self = this;
            let arr = self.receiveComments;
            let arr2 = self.receiveItem;
            let a = [];
            //  console.log(arr2.user_id);
             // console.log(self.receiveItem.user_id);
            // console.log(arr);
            // console.log(self.receiveComments);
            for (let comment of arr) {
                if(comment.user_id != arr2.user_id ){
                // console.log(comment.user_id);
                   a.push(comment);
                }
            }
            return a;
       },
       proposeComments: function(){
           const self = this;
            let arr = self.receiveComments;
            // let arr3 = JSON.parse(self.receiveComments);
            // console.log(arr);
            // console.log(arr3);
            let arr2 = self.receiveItem;
            let b = [];
            //  console.log(arr2.user_id);
             // console.log(self.receiveItem.user_id);
            // console.log(arr);
            // console.log(self.receiveComments);
            for (let comment of arr) {
                if(comment.user_id == arr2.user_id ){
                // console.log(comment.user_id);
                   b.push(comment);
                }
            }
            return b;
       }

    },
    methods:{
        changeToJson: function(){
            const self = this;
            let arr = self.comments;
            let arr2 = self.item;
            //  console.log(arr2.user_id);
             // console.log(self.receiveItem.user_id);
            // console.log(arr);
            // console.log(self.receiveComments);
            for (let comment of arr) {
                if(comment.user_id != arr2.user_id ){
                // console.log(comment.user_id);
                    self.applyComments.push(comment);
                }else{
                    self.proposeComments.push(comment);
                }
            }
             console.log(self.applyComments);
            console.log(self.proposeComments);
        },
        fetchCommentList: function(){
            const self = this;
             console.log('Fetching Comments...');
             axios.get('/api/index').then((response) => {
                console.log(response.data);
                self.receiveComments = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
    },
        createComment: function(){
            console.log('Creating input...');
            let self = this;
            let params = Object.assign({}, self.input);
            console.log(params);
            axios.post('/api/comment',params)
            .then(function(response){
            self.input.comment = '';
            self.receiveComments = response.data;

            })
            .catch(function(error){
                console.log(error.response.data.errors);
                console.log(error.response.data.errors.comment);
                self.errorMessages = error.response.data.errors;
           });


        }
    }
}
</script>
