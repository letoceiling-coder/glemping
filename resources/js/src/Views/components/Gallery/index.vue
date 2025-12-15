<template>
    <swiper
        :style="{
      '--swiper-navigation-color': '#fff',
      '--swiper-pagination-color': '#fff',
    }"
        :spaceBetween="10"
        :navigation="{nextEl:'.arrow-next',prevEl:'.arrow-prev'}"
        :thumbs="{ swiper: thumbsSwiper }"
        :modules="modules"
        :autoHeight="true"

        class="mySwiper2 relative "
    >
        <swiper-slide v-for="image in images">
            <div class="relative">
                <picture >
                    <source :srcset="image.webp"
                            type="image/webp">
                    <img :src="image.src" class="w-100">

                </picture>
                <div class="absolute label">
                    <slot></slot>
                </div>
            </div>

        </swiper-slide>
        <div class="arrow-prev absolute flex-center m-hidden-lg">

            <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.75 1L1.75 8L8.75 15" stroke="#EDEDED" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        </div>
        <div class="arrow-next absolute flex-center m-hidden-lg">
            <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.25 15L8.25 8L1.25 1" stroke="#EDEDED" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>


        </div>
    </swiper>
    <swiper
        @swiper="setThumbsSwiper"
        :spaceBetween="10"
        :slidesPerView="4"
        :loop="true"

        :freeMode="true"
        :watchSlidesProgress="true"
        :modules="modules"

        class="mySwiper mt-3 d-none d-md-block"
    >
        <!--        :centeredSlides="true"-->
        <swiper-slide  v-for="image in images">

            <picture>
                <source :srcset="image.webp"
                        type="image/webp">
                <img :src="image.src" class="w-100">
            </picture>

        </swiper-slide>
    </swiper>
</template>

<script>
import {Swiper, SwiperSlide} from 'swiper/vue';

import 'swiper/css';

import 'swiper/css/free-mode';
import 'swiper/css/navigation';
import 'swiper/css/thumbs';




import {FreeMode, Navigation, Thumbs} from 'swiper/modules';

export default {
    props:{
        images:{type:Object,default:[]}
    },
    components: {
        Swiper,
        SwiperSlide,
    },
    data() {
        return {
            thumbsSwiper: null,

            modules: [FreeMode, Navigation, Thumbs],
        }
    },
    methods: {
        setThumbsSwiper(swiper) {
            this.thumbsSwiper = swiper;
        },
    },

    name: "swiper-in-swiper"
}
</script>

<style scoped lang="scss">
.mySwiper2{

    border-radius: 15px;

    img{
        border-radius: 15px;
        aspect-ratio:16/9;
    }


}
.mySwiper {


    img{
        border-radius: 14px;
        aspect-ratio:16/9;
    }
}
.mySwiper .swiper-slide {
    width: 25%;
    height: 100%;
    opacity: 0.4;
}
.mySwiper .swiper-slide-thumb-active {
    opacity: 1;
}
@media only screen and (max-width: 768px) {
    .mySwiper2{
        margin-bottom: 20px;
    }
}

.label{
    top: 25px;
    left: 25px;
    padding: 7px 15px;
    background: rgba(255, 255, 255, 0.23);
    backdrop-filter: blur(1.05px);
    border-radius: 45px;
    transform: matrix(1, 0, 0, 1, 0, 0);
    font-family: 'TT Interfaces',serif;
    font-style: normal;
    font-weight: 400;
    font-size: 13px;
    line-height: 22px;

    color: #FFFFFF;





}
.swiper-button-disabled{
    display: none;
}
.arrow-prev,.arrow-next{
    top: calc(50% - 18px);
    z-index: 5;
    cursor: pointer;
    border-radius:50%;
    border: 1.75px solid #EDEDED;

    height: 40px;
    width: 40px;

}
.arrow-prev{
    left: 25px;
}
.arrow-next{
    right: 25px;
}
</style>
