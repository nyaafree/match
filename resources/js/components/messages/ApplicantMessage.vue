<template>
    <div>
        <div class="c-comment__questioner">
            <div class="c-comment__imgArea">
                <img :src="imgFolder + aplMessage.user.photo.filename" alt="" class="c-comment__image"
                @click="showProfile($event)" v-if="aplMessage.user.photo != null">
                <img :src="imgFolder + 'noimage.png'" class="c-comment__image" @click="showProfile($event)"
                v-else>
            </div>
            <div class="c-comment__question">
                <div class="c-comment__says">
                    <p>{{ aplMessage.message }}</p>
                </div>
            </div>
        </div>
         <show-profile :item="aplMessage" ref="child"/>
    </div>
</template>

<script>
import showProfile from "../showProfile";
export default {
        props: ['aplMessage'],
    data(){
        return{
            imgFolder: '/match/images/profile/',

        }
    },
    mounted(){
        console.log(this.Message);
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
