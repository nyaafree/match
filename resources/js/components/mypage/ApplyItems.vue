<template>
    <div>
         <h1 class="index-title" id="apply">応募案件一覧</h1>
         <a :href="'items/' + board.item.id" class="c-panel" v-for="(board, index) in applyItems" :key="board.id" >
        <div class="c-panel__container1">
            <h2 class="c-panel__title">{{ board.item.title }}</h2>
                <div class="c-panel__prof" @click="showProfile(index, $event)">
                    <span class="c-panel__span">registered by</span>
                    <img :src="imgFolder + board.item.user.photo.filename" class="c-panel__img">
                    <span class="c-panel__span">{{ board.item.user.name }}</span>
                </div>
        </div>
        <div class="c-panel__container2">
            <h4 class="c-panel__category">{{ board.item.category.name }}</h4>
            <div class="c-panel__price" v-if="board.item.category_id == 1">¥{{ board.item.lowPrice}} ~ {{ board.item.highPrice }}</div>

        </div>
        <div class="c-panel__detail">
            {{ board.item.detail.substr(0,110)}}...read more
        </div>
        <div class="c-panel__boards">
            <h3>取引掲示板</h3>
            <a :href="'board/' + board.id "  style="display:block;">掲示板番号{{ board.id }}</a>
        </div>
        <show-profile :item="board.item" ref="child"/>

       </a>
    </div>
</template>

<script>
export default {
    props:['applyItems'],
    data(){
        return{
            receiveApplyItems: this.applyItems,
            imgFolder: 'images/profile/',

        }
    },
     mounted(){
        console.log(this.applyItems)
    },
    methods:{
         showProfile: function(index, event){
            console.log('clicked!!');
            event.preventDefault();
            this.$refs.child[index].showUser();
        },
    }
}
</script>
