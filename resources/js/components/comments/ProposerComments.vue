<template>
    <div>
        <div class="c-comment__answer">
            <p>
                {{ prpComment.comment}}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props:['prpComment'],
    mounted(){
        console.log(this.prpComment);
    }
}
</script>
