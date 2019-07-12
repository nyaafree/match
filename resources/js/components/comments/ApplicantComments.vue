<template>
    <div>
        <div class="c-comment__questioner"  v-for="comment in aplComments" :key="comment.key">
            <div class="c-comment__imgArea">
                <img :src="imgFolder + comment.user.photo.filename" alt="" class="c-comment__image">
            </div>
            <div class="c-comment__question">
                <div class="c-comment__says">
                    <p>{{ comment.comment }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['aplComments'],
    data(){
        return{
            imgFolder: '/images/profile/',

        }
    },
    mounted(){
        console.log(this.aplComments);
    }
}
</script>
