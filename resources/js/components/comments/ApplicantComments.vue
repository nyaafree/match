<template>
    <div>
        <div class="c-comment__questioner">
            <div class="c-comment__imgArea">
                <img :src="imgFolder + aplComment.user.photo.filename" alt="" class="c-comment__image" @click="showProfile($event)"
                v-if="aplComment.user.photo != null">
                <img :src="imgFolder + 'noimage.png'" class="c-comment__image" @click="showProfile($event)" v-else>
            </div>
            <div class="c-comment__question">
                <div class="c-comment__says">
                    <p>{{ aplComment.comment }}</p>
                </div>
            </div>
        </div>
         <show-profile :item="aplComment" ref="child"/>
    </div>
</template>

<script>

import showProfile from "../showProfile";
export default {
    // props: ['aplComments'],
        props: ['aplComment'],
    data(){
        return{
            imgFolder: '/match/images/profile/',

        }
    },
    mounted(){
        console.log(this.aplComment);
        // console.log(this.baseUrl);
    },
    methods:{
        showProfile: function(event){
            console.log('clicked!!');
            event.preventDefault();
            this.$refs.child.showUser();
        },
    },
    components:{
        showProfile,
    }
}
</script>
