<template>
    <div>
        <div class="c-comment__answer">
            <p>
                {{ prpMessage.message}}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props:['prpMessage'],
    mounted(){
        console.log(this.prpMessage);
    }
}
</script>
