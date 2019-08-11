<template>
    <div>
        <div class="c-comment" v-if="showMessages">
            <div v-for="message in receiveMessages" :key="message.id">
                  <proposer-message  :prp-message="message" v-if="message.user_id == receiveItem.user_id"/>
                  <applicant-message :apl-message="message" v-else/>
            </div>
        </div>
    </div>
</template>

<script>
    import ApplicantMessage from "./messages/ApplicantMessage";
    import ProposerMessage from "./messages/ProposerMessage";
    export default {
        props:['messages','item','user'],
        data(){
            return{
                receiveMessages: JSON.parse(this.messages),
                receiveItem: JSON.parse(this.item),
                showMessages: false,
            
        }
    },
    create(){

    },
    mounted(){
       if(Object.keys(this.receiveMessages).length != 0){
           // 投稿したダイレクトメッセージ数が１つでもあればtrueにする
            this.showMessages = true;
        }
    },
    components:{
        ApplicantMessage,
        ProposerMessage,
    },
    methods:{
        fetchCommentList: function(){
            // ダイレクトメッセージをやり取りする掲示板に表示されているダイレクトメッセージ一覧を取得
            const self = this;
             console.log('Fetching Comments...');
             axios.get('../api/index').then((response) => {
                console.log(response.data);
                self.receiveComments = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
    },
        createComment: function(){
           // ダイレクトメッセージを投稿
            console.log('Creating input...');
            let self = this;
            let params = Object.assign({}, self.input);
            console.log(params);
            axios.post('../api/comment',params)
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
