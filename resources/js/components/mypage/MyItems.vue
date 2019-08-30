<template>
    <div>
        <h1 class="index-title" id="register">登録案件一覧</h1>
        <a :href="'/match/items/' + item.id" class="c-panel" v-for="(item, index) in receiveMyItems" :key="item.id" >
        <div class="c-panel__container1">
            <h2 class="c-panel__title">{{ item.title }}</h2>
            <div class="c-panel__prof" @click="showProfile(index, $event)">
                <span class="c-panel__span">registered by</span>
                <!-- 案件投稿者がプロフィール写真を登録していれば表示 -->
                <img :src="imgFolder + item.user.photo.filename" class="c-panel__img" v-if="item.user.photo != null">
                <!-- 登録していなければnoimage.pnを表示 -->
                <img :src="imgFolder + 'noimage.png' "  class="c-panel__img" v-else>
                <span class="c-panel__span">{{ item.user.name }}</span>
            </div>
        </div>
        <div class="c-panel__container2">
            <h4 class="c-panel__category">{{ item.category.name }}</h4>
            <div class="c-panel__price" v-if="item.category_id == 1">¥{{ item.lowPrice}} ~ {{ item.highPrice }}</div>
        </div>
        <div class="c-panel__detail">{{ item.detail.substr(0,110)}}...read more</div>
        <div class="c-panel__boards">
            <h3>取引掲示板一覧 応募総数{{ Object.keys(item.boards).length }}件</h3>
            <!-- 自分が投稿した案件に応募したユーザーとダイレクトメッセージをやり取りする掲示板へのリンクを表示 -->
            <a :href="'/match/board/' + board.id " v-for="board in item.boards" :key="board.id" style="display:block;">掲示板番号{{ board.id }}
             応募ユーザー: {{ board.apply.user.name }}</a>
        </div>
        <a :href="'/match/items/' + item.id + '/edit' "><button class="btn btn-yellow">編集</button></a>
        <form :action="'/match/items/' + item.id " style="display:inline" method="POST">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-lightred" type="submit" @click="deleteItem()">削除</button>
        </form>
         <show-profile :item="item" ref="child"/>
    </a>
    </div>
</template>

<script>
export default {
    props:['myItems'],
    data(){
        return{
            receiveMyItems: this.myItems,
            imgFolder: '/match/images/profile/',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

        }
    },
    mounted(){
        console.log(this.myItems);
    },
    methods:{
        // 自分が投稿した案件一覧を表示
        fetchMyItems(){
            console.log('fetching MyItems ....');
            axios.get('api/items').then((response) => {
                console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
        },
        deleteItem(){
            // 自分が投稿した案件を削除
            let self = this;
	        if(window.confirm('本当に登録案件を削除しますか？')){
                //  削除ボタンを押してモーダルで確認
                console.log('deleting Items ...');
                return true;
	        }
	        // 「OK」時の処理終了

	        // 「キャンセル」時の処理開始
	        else{
               event.preventDefault();

	        }

        },
         showProfile: function(index, event){
             // プロフィール表示用のモーダルを表示
            console.log('clicked!!');
            // パネル全体がaタグなのでページ遷移を防ぐ
            event.preventDefault();
            // 子コンポーネント<show-profile/>のshowUser()メソッドを実行
            this.$refs.child[index].showUser();
        },
    }
}
</script>
