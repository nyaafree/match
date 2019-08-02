<template>
    <div>
            <h1 class="c-post__title">案件編集</h1>
            <div class="c-post__formArea">
                <form :action="'/items/' + item.id" method="POST" class="c-post__form">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="c-post__inputGroup">
                        <label for="title" class="c-post__labelTitle">案件タイトル</label>
                        <input type="text" class="c-post__input" name="title" id="title" v-model="input.title">
                    </div>
                    <div class="c-post__inputGroup">
                        <label for="category_id" class="c-post__labelTitle">案件カテゴリ</label>
                        <select name="category_id" id="category_id" class="c-post__select" v-model="input.category_id">
                            <option class="c-post__option" value="">カテゴリを選択してください</option>
                            <option :value="category.id" v-for="category in categories" :key="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div class="c-post__inputGroup">
                        <label for="detail" class="c-post__labelTitle">詳細情報</label>
                        <textarea name="detail" class="c-post__input text-left" id="detail" cols="30" rows="10" v-model="input.detail">

                        </textarea>
                    </div>
                    <div class="c-post__inputGroup">
                        <label for="" class="c-post__labelTitle" v-if="input.category_id == 1">価格帯</label>
                        <div class="c-post__priceWrapper" v-if="input.category_id == 1">

                           <div>
                               <input type="text" name="lowPrice" class="c-post__price" v-model="input.lowPrice"><span>000</span>
                           </div>
                           <span class="c-post__center">〜</span>
                           <div>
                               <input type="text" name="highPrice" class="c-post__price" v-model="input.highPrice"><span>000</span>
                           </div>
                        </div>
                    </div>
                    <div class="c-post__submit">
                        <button type="submit" class="btn-purple btn-wide">投稿する</button>
                    </div>


                </form>
            </div>
    </div>
</template>

<script>
export default {
    props:['user','categories','errors','olds','item'],
    data(){
        return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            input:{
                title: this.item.title,
                category_id: this.item.category_id,
                detail: this.item.detail,
                lowPrice: this.item.lowPrice/1000,
                highPrice: this.item.highPrice/1000,
            },
            receiveOlds: this.olds,
        }
    },
    mounted(){
        console.log(this.user);
        console.log(this.olds);
          if(Object.keys(this.olds).length != 0){
            this.input.title = this.olds.title;
            this.input.category_id = this.olds.category_id;
            this.input.detail = this.olds.detail;
            this.input.lowPrice = this.olds.lowPrice;
            this.input.highPrice = this.olds.highPrice;
        }
    }
}
</script>
