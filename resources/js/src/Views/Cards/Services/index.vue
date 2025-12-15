<template>
    <div class="image-card relative mb-4" @click="showModal(service)">

        <picture>
            <source :srcset="service.image_id.webp"
                    type="image/webp">
            <img :src="service.image_id.src" :alt="service.image_id.name" class="w-100">
        </picture>
        <div class="absolute  flex column jc-sb h-100 w-100 p-3">
            <div class="label-price flex justify-content-end w-100">
                <span>от {{ service.price }}  ₽</span>
            </div>
            <div class="title">{{ service.name }}</div>
        </div>
    </div>

</template>

<script>
export default {
    name: "index",
    props: {
        service: Object
    },
    methods:{
        showModal(service){
            this.storage.service = service
            $('#modal-signUpService').modal('toggle')
        }
    }
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';

.absolute {
    top: 0;
    left: 0;
    z-index: 10;
}

.label-price {
    span {
        background: #00BA57;
        backdrop-filter: blur(1.59709px);
        border-radius: 15.9709px;
        padding: 3px 15px;
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 600;
        @include adaptiv-font(14, 12);

        line-height: 17px;
        color: #FFFFFF;
    }

}

.title {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    @include adaptiv-font(20, 16);
    line-height: 28px;
    color: #FFFFFF;
}

.image-card {
    img {
        border-radius: 15px;

    }

    &::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        background: rgb(0, 0, 0, 0.5);
        background: -webkit-gradient(linear, left bottom, left top, from(rgb(0, 0, 0, 0.5)), color-stop(30%, rgb(255, 255, 250, 0)));
        background: linear-gradient(0deg, rgb(0, 0, 0, 0.5) 0%, rgb(255, 255, 250, 0) 50%);
    }
}
</style>


