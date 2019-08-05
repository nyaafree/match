<template>
    <div>
        <a :href="'items/' + item.id" class="c-panel">
        <div class="c-panel__container1">
            <h2 class="c-panel__title">{{ item.title }}</h2>
                <div class="c-panel__prof" @click="showProfile($event)">
                    <span class="c-panel__span">registered by</span>
                    <img :src="imgFolder + item.user.photo.filename" class="c-panel__img">
                    <span class="c-panel__span">{{ item.user.name }}</span>


                </div>
        </div>
        <div class="c-panel__container2">
            <h4 class="c-panel__category">{{ item.category.name }}</h4>
            <div class="c-panel__price" v-if="item.category_id == 1">¥{{ item.lowPrice}} ~ {{ item.highPrice }}</div>
        </div>
        <div class="c-panel__detail">
            {{ item.detail.substr(0,110)}}...read more
        </div>
        <show-profile :item="item" ref="child"/>

    </a>
    </div>
</template>

<script>
import showProfile from "../showProfile";
export default {
    props:['item'],
    data(){
        return{
             imgFolder: "images/profile/",
        }
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
