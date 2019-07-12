<template>
    <div>
        <div class="c-comment">
            <applicant-comments :aplComments="applyComments"/>
            <proposer-comments  :prpComments="proposeComments"/>
        </div>
        <form action="" @submit.prevent=" createComment() ">
            <!-- <input type="hidden" name="_token" :value="csrf"> -->
            <div class="p-item__container1">
                <textarea name="comment" cols="30" rows="8" class="p-item__input" v-model="input.comment">

                </textarea>
                <button type="submit" class="btn btn-lightblue">コメントする</button>
            </div>
        </form>

    </div>
</template>

<script>
import ApplicantComments from "./comments/ApplicantComments";
import ProposerComments from "./comments/ProposerComments";
// import allComments from "./comments/AllComments";
// import SubmitComment from "./comments/SubmitComment";

export default {
    props:['comments','item'],
    data(){
        return{
            receiveComments: this.comments,
            receiveItem: this.item,
            // proposeComments:[],
            // applyComments: [],

            input:{
                id: JSON.parse(this.item).id,
                comment:'',
            },
            // csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    create(){
    //    this.changeToJson();
    },
    mounted(){
        // console.log(this.comments);
        // console.log(this.receiveComments);
        // this.changeToJson();
        //   self.applyComments = JSON.stringify(self.applyComments);
        //   self.proposeComments = JSON.stringify(self.proposeComments);


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
            let arr = JSON.parse(self.receiveComments);
            let arr2 = JSON.parse(self.receiveItem);
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
            let arr = JSON.parse(self.receiveComments);
            // let arr3 = JSON.parse(self.receiveComments);
            // console.log(arr);
            // console.log(arr3);
            let arr2 = JSON.parse(self.receiveItem);
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
            let arr = JSON.parse(self.comments);
            let arr2 = JSON.parse(self.item);
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
                self.receiveComments = JSON.stringify(response.data);
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
            self.receiveComments = JSON.stringify(response.data);

            })
            .catch(function(error){
                console.log(error.response);
           });


        }
    }
}
</script>
