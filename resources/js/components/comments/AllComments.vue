<template>
    <div>
        <applicant-comments v-if="comment.user_id != item.user_id"/>
        <proposer-comments v-else />
    </div>
</template>

<script>
import ApplicantComments from "./ApplicantComments";
import ProposerComments from "./ProposerComments";
export default {
    props:['item'],
    components:{
        ApplicantComments,
        ProposerComments
    }
}
</script>
