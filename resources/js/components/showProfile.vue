<template>
    <div>
        <div class="modal-window" :class="{ 'is-hide': isActive }" @click="preventLoad($event)">
            <div class="p-modal">
                <div class="p-modal__container1">
                    <img :src="imgFolder + item.user.photo.filename" class="p-modal__img">
                    <div class="p-modal__container2">
                        <h2 class="p-modal__title">ユーザー名:{{ item.user.name}}</h2>
                        <h2 class="p-modal__title">自己紹介</h2>
                        <p class="p-modal__introduction">{{ item.user.introduction }}</p>
                    </div>
                </div>
                <span class="hide-profile" @click="profileHide($event)"><i class="far fa-times-circle"></i></span>
            </div>
        </div>
        <div class="cover" :class="{'is-hide': isActive }" @click="profileHide($event)">

        </div>
    </div>
</template>

<script>
export default {
    props:['item'],
    data(){
        return{
            isActive: true,
            imgFolder: "images/profile/",
        }
    },
    methods:{
        showUser(){
            this.isActive = false;
        },
        profileHide(event){
            event.preventDefault();
            this.isActive = true;
        },
        preventLoad(event){
            event.preventDefault();
        },
    }

}
</script>
