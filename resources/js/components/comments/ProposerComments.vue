<template>
    <div>
        <div class="c-comment__answer" v-for="comment in prpComments" :key="comment.key" >
            <p>
                {{ comment.comment}}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props:['prpComments'],
    mounted(){
        console.log(this.prpComments);
    }
}
</script>
