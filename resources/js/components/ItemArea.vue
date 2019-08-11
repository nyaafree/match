<template>
  <div>
    <div class="flex-right">
        <form action="">
            <input type="hidden" name="_token" v-bind:value="csrf">
            <select name="category" id="category" @change="registerId()" class="c-post__select"
            v-model="itemCategory.id">
                <option class="c-post__option" value="0">全ての案件を表示</option>
                <option :value="category.id" v-for="category in categories" :key="category.id">
                    {{ category.name }}
                </option>
            </select>
        </form>
    </div>
    <item-component :item = item  v-for=" item in displayItems" :key="item.key"/>
    <div class="container paginate-original" id="paging">
        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <a @click="first" class="page-link" href="#">&laquo;</a>
                </li>
                <li class="page-item">
                    <a @click="prev" class="page-link" href="#">&lt;</a>
                </li>
                <li
                v-for="i in displayPageRange"
                class="page-item"
                :class="{active: i-1 === currentPage}" :key="i.id">
                    <a @click="pageSelect(i)" class="page-link" href="#">{{ i }}</a>
                </li>  
                <li class="page-item">
                    <a @click="next" class="page-link" href="#">&gt;</a>
                </li>
                <li class="page-item">
                    <a @click="last" class="page-link" href="#">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>
  </div>
</template>

<script>
import showProfile from "./showProfile";
require('../object-assign');
export default {
  components:{
      showProfile,
  },
  props:['categories','items','csrf'],
  data(){
      return{
          receiveItems: this.items,
          itemCategory: {
              id: 0,
          },
          currentPage: 0,   // 現在のページ番号
          size: 5,         // 1ページに表示するアイテムの上限
          pageRange: 5,    // ページネーションに表示するページ数の上限
      }
  },
  created(){
   
  },
  mounted(){
      console.log(this.receiveItems);
  },
  computed: {
    /**
     * ページ数を取得する
     * @return {number} 総ページ数(1はじまり)
     */
    pages () {
      // 案件総数を１ページに表示する案件数で割ったものの小数点を切り上げてページ総数を取得
      return Math.ceil(this.receiveItems.length / this.size);
    },
    /**
     * ページネーションで表示するページ番号の範囲を取得する
     * @return {Array<number>} ページ番号の配列
     */
    displayPageRange () {
      const half = Math.ceil(this.pageRange / 2);
      // startは最初のページ番号、endは最後のページ番号
      let start, end;

      if (this.pages < this.pageRange) {
        // ページネーションのrangeよりページ数がすくない場合
        start = 1;
        end = this.pages;

      } else if (this.currentPage < half) {
        // 左端のページ番号が1になったとき
        start = 1;
        end = start + this.pageRange - 1;

      } else if (this.pages - half < this.currentPage) {
        // 右端のページ番号が総ページ数になったとき
        end = this.pages;
        start = end - this.pageRange + 1;

      } else {
        // activeページを中央にする
        start = this.currentPage - half + 1;
        end = this.currentPage + half;
      }

      let indexes = [];
      for (let i = start; i <= end; i++) {
        indexes.push(i);
      }
      return indexes;
    },
    /**
     * 現在のページで表示するアイテムリストを取得する
     * @return {any} 表示用アイテムリスト
     */
    displayItems () {
      const head = this.currentPage * this.size;
      // slice()を使って全ての案件情報が入った配列から現在のページで表示する物を切り出した配列オブジェクトをreturnする
      return this.receiveItems.slice(head, head + this.size);
    },
    /**
     * 現在のページかどうか判定する
     * @param {number} page ページ番号
     * @return {boolean} 現在のページならtrue
     */
    isSelected (page) {
      // ページは0から始まるので１を引く
      return page - 1 === this.currentPage;
    }
  },
  methods:{
     registerId: function(){
         // セレクトボックスで選択したカテゴリの案件情報をaxiosで一括取得する。
          let self = this;
          let params = Object.assign({}, self.itemCategory);
          console.log(params);
          axios.post('api/category',params)
          .then((response)=>{
              console.log('success');
            //   console.log(response.data.items);
              self.receiveItems = response.data;
              self.currentPage = 0;
              console.log(self.receiveItems);

          }).catch((error)=>{
              console.log(error);
          })
        },

        /**
     * ページ先頭に移動する
     */
    first () {
      this.currentPage = 0;
      this.selectHandler();
    },
    /**
     * ページ後尾に移動する
     */
    last () {
      this.currentPage = this.pages - 1;
      this.selectHandler();
    },
    /**
     * 1ページ前に移動する
     */
    prev () {
      if (0 < this.currentPage) {
        this.currentPage--;
        this.selectHandler();
      }
    },
    /**
     * 1ページ次に移動する
     */
    next () {
      if (this.currentPage < this.pages - 1) {
        this.currentPage++;
        this.selectHandler();
      }
    },
    /**
     * 指定したページに移動する
     * @param {number} index ページ番号
     */
    pageSelect (index) {
      this.currentPage = index - 1;
      this.selectHandler();
    },
    /**
     * ページを変更したときの処理
     */
    selectHandler () {
      // なんかの処理
    }
  }



}
</script>
