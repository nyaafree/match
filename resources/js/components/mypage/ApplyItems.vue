<template>
    <div>
        <h1 class="index-title" id="apply">応募案件一覧</h1>
        <a :href="'/match/items/' + board.item.id" class="c-panel" v-for="(board, index) in applyItems" :key="board.id" >
        <div class="c-panel__container1">
            <h2 class="c-panel__title">{{ board.item.title }}</h2>
                <!-- クリックしたらプロフィール表示用のモーダルを表示 -->
                <div class="c-panel__prof" @click="showProfile(index, $event)">
                    <span class="c-panel__span">registered by</span>
                    <!-- 案件投稿ユーザーのプロフィール画像が登録されていればそれを表示 -->
                    <img :src="imgFolder + board.item.user.photo.filename" class="c-panel__img" v-if="board.item.user.photo != null">
                    <!-- 登録されていなければnoimageの画像を表示 -->
                    <img :src="imgFolder + 'noimage.png'" class="c-panel__img" v-else>
                    <span class="c-panel__span">{{ board.item.user.name }}</span>
                </div>
        </div>
        <div class="c-panel__container2">
            <h4 class="c-panel__category">{{ board.item.category.name }}</h4>
            <!-- 案件が単発案件なら価格帯を表示、レベニューシア案件なら価格帯は非表示 -->
            <div class="c-panel__price" v-if="board.item.category_id == 1">¥{{ board.item.lowPrice}} ~ {{ board.item.highPrice }}</div>
        </div>
        <div class="c-panel__detail">{{ board.item.detail.substr(0,110)}}...read more</div>
        <div class="c-panel__boards">
            <h3>取引掲示板</h3>
            <!--  案件に応募してきたユーザーとのダイレクトメッセージをやり取りする掲示板のリンク -->
            <a :href="'/match/board/' + board.id "  style="display:block;">掲示板番号{{ board.id }}</a>
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
            imgFolder: '/match/images/profile/',

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
