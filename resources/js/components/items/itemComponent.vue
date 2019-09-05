<template>
    <div>
        <a :href="'/match/items/' + item.id" class="c-panel">
            <div class="c-panel__container1">
                <h2 class="c-panel__title">{{ item.title }}</h2>
                <div class="c-panel__prof" @click="showProfile($event)">
                    <span class="c-panel__span">registered by</span>
                    <!-- 案件投稿ユーザーのプロフィール写真が登録されていればそれを表示 -->
                    <img :src="imgFolder + item.user.photo.filename" class="c-panel__img" v-if="item.user.photo != null">
                    <!-- 登録されていなければnoimage画像を表示 -->
                    <img :src="imgFolder + 'noimage.png'" class="c-panel__img" v-else>
                    <span class="c-panel__span">{{ item.user.name }}</span>
                </div>
            </div>
            <div class="c-panel__container2">
                <h4 class="c-panel__category">{{ item.category.name }}</h4>
                <!-- 案件が単発案件なら価格帯を表示、レベニューシア案件なら価格帯は非表示 -->
                <div class="c-panel__price" v-if="item.category_id == 1">¥{{ item.lowPrice}} ~ {{ item.highPrice }}</div>
            </div>
            <div class="c-panel__detail">{{item.detail.substr(0,110)}}...read more</div>
              <span class="apply-done" v-if="applyOrNot">
                応募済み
              </span>
              <span class="not-apply" v-else>
                未応募
              </span>
            <show-profile :item="item" ref="child"/>
        </a>
    </div>
</template>

<script>
import showProfile from "../showProfile";
export default {
    props:['item','user'],
    data(){
        return{
             imgFolder: "/match/images/profile/",
             receiveUser: JSON.parse(JSON.stringify(this.user)),
             receiveItem: JSON.parse(JSON.stringify(this.item.applies)),
             // applyOrNotがtrueであればこの案件は応募済み、falseであれば未応募と表示される
             applyOrNot: ''
        }
    },
    mounted(){
        // console.log(this.item.user.photo);
        // console.log(this.item.applies);
        // console.log(this.receiveUser.id);JSON.parse(user)JSON.parse(user)JSON.parse(user)
        console.log(this.item);
        this.applyJodge();


    },
    watch:{
        item: function(){
            console.log(JSON.parse(JSON.stringify(this.item)).applies);
            this.applyJodge();
        }
    },
    computed:{
        // applyOrNot(){
        //     let self = this;
        //     if(JSON.parse(JSON.stringify(this.user)) != null){
        //        JSON.parse(JSON.stringify(this.item.applies)).some( (apply) => apply.user_id == JSON.parse(JSON.stringify(this.user)).id);
        //     }
        //     // return JSON.parse(JSON.stringify(this.item.applies))
        // }
    },
    methods:{
         showProfile: function(event){
            console.log('clicked!!');
            event.preventDefault();
            this.$refs.child.showUser();
        },
        applyJodge(){
            let self = this;
            // ログインしてる場合は応募済みかどうかの判定を行う
            if(JSON.parse(JSON.stringify(this.user)) != null){
                console.log(JSON.parse(JSON.stringify(self.item)).applies);
                console.log(JSON.parse(JSON.stringify(self.item)).applies.some( (apply) => apply.user_id == JSON.parse(self.user).id));
                // この案件への応募情報一覧の中に応募ユーザーのIDとログインユーザーのIDが一致するものがあればtrueをdata属性applyOrNotの中に入れる
                self.applyOrNot =  JSON.parse(JSON.stringify(self.item)).applies.some( (apply) => apply.user_id == JSON.parse(self.user).id);
            }
        }
    },
    components:{
        showProfile,
    }
}
</script>
