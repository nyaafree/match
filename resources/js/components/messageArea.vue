<template>
    <div>
        <div class="c-comment" v-if="showMessages">
            <!-- <applicant-comments :aplComments="applyComments"/>
            <proposer-comments  :prpComments="proposeComments"/> -->
            <!-- <applicant-comments :apl-comment="aplComment" v-for="aplComment in applyComments" :key="aplComment.id"/>
            <proposer-comments  :prp-comment="prpComment" v-for="prpComment in proposeComments" :key="prpComment.id"/> -->
            <div v-for="message in receiveMessages" :key="message.id">
                <!-- <applicant-comments :apl-comment="comment" v-if="comment.user_id != item.user_id"/>
                <proposer-comments  :prp-comment="comment" v-else/> -->
                  <proposer-message  :prp-message="message" v-if="message.user_id == receiveItem.user_id"/>

                  <applicant-message :apl-message="message" v-else/>
            </div>
        </div>
    </div>
</template>

<script>
import ApplicantMessage from "./messages/ApplicantMessage";
import ProposerMessage from "./messages/ProposerMessage";
// import allComments from "./comments/AllComments";
// import SubmitComment from "./comments/SubmitComment";

export default {
    props:['messages','item','user'],
    data(){
        return{
            receiveMessages: JSON.parse(this.messages),
            receiveItem: JSON.parse(this.item),
            // proposeComments:[],
            // applyComments: [],


            showMessages: false,
            // csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    create(){

    },
    mounted(){
       if(Object.keys(this.receiveMessages).length != 0){
            this.showMessages = true;
        }
        // this.input.id = this.receiveItem.id;

    },
    components:{
        ApplicantMessage,
        ProposerMessage,
    },
    // computed:{
    //    applyMessages: function(){
    //         const self = this;
    //         let arr = self.receiveComments;
    //         let arr2 = self.receiveItem;
    //         let a = [];
    //         //  console.log(arr2.user_id);
    //          // console.log(self.receiveItem.user_id);
    //         // console.log(arr);
    //         // console.log(self.receiveComments);
    //         for (let comment of arr) {
    //             if(comment.user_id != arr2.user_id ){
    //             // console.log(comment.user_id);
    //                a.push(comment);
    //             }
    //         }
    //         return a;
    //    },
    //    proposeMessages: function(){
    //        const self = this;
    //         let arr = self.receiveComments;
    //         // let arr3 = JSON.parse(self.receiveComments);
    //         // console.log(arr);
    //         // console.log(arr3);
    //         let arr2 = self.receiveItem;
    //         let b = [];
    //         //  console.log(arr2.user_id);
    //          // console.log(self.receiveItem.user_id);
    //         // console.log(arr);
    //         // console.log(self.receiveComments);
    //         for (let comment of arr) {
    //             if(comment.user_id == arr2.user_id ){
    //             // console.log(comment.user_id);
    //                b.push(comment);
    //             }
    //         }
    //         return b;
    //    }

    // },
    methods:{
        // changeToJson: function(){
        //     const self = this;
        //     let arr = self.comments;
        //     let arr2 = self.item;
        //     //  console.log(arr2.user_id);
        //      // console.log(self.receiveItem.user_id);
        //     // console.log(arr);
        //     // console.log(self.receiveComments);
        //     for (let comment of arr) {
        //         if(comment.user_id != arr2.user_id ){
        //         // console.log(comment.user_id);
        //             self.applyComments.push(comment);
        //         }else{
        //             self.proposeComments.push(comment);
        //         }
        //     }
        //      console.log(self.applyComments);
        //     console.log(self.proposeComments);
        // },
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
                console.log(error.response);
           });


        }
    }
}
</script>
