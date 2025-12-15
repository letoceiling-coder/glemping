<template>

    <div  :class="this.appendClass(data.view)" :id="`id-${data.id}`">
        <div class="bg-bron relative pb-3 pt-5" :style="`background: url(${getField('bg-image').image.webp}) 0% 0% / cover no-repeat;`">
            <div class="container z-10 relative" v-if="this.storage.width > 767">
                <div class="absolute w-100 h-100 flex-center">
                    ЛЕС ВОКРУГ
                </div>
                <div class="row">
                    <div class="col-md-3" v-for="(image,index) in getField('info').data">

                        <picture >
                            <source :srcset="image.image.webp"
                                    type="image/webp">
                            <img :src="image.image.src" :alt="image.image.name" class="w-100" :class="isEven(index) ? 'mt-5' : ''">
                        </picture>
                    </div>
                </div>

                <div class="flex-center mt-5">
                    <p>Забронируйте прямо сейчас в один клик</p>
                </div>

                <div class="flex-center mt-4 gab-20 pb-5 z-10 relative">
                    <Btn :btn="{
                  method:'method',
                  route:'singBron',
                  view:'btn-default'
              }">ЗАБРОНИРОВАТЬ</Btn>
                    <Btn :btn="{
              method:'method',
              route:'singBron',
              view:'btn-white'
              }">ОБРАТНЫЙ ЗВОНОК</Btn>
                </div>

            </div>
            <div class="container z-10 relative" v-else>
                <swiper :slidesPerView="1"
                        :space-between="10"
                        :autoplay="{
                                      delay: 5000,
                                      disableOnInteraction: true,
                                    }"
                        :pagination="true"
                        :modules="modules"
                        class="my-swiper relative"

                >
                    <swiper-slide v-for="image in getField('info').data" class="relative">

                        <picture >
                            <source :srcset="image.image.webp"
                                    type="image/webp">
                            <img :src="image.image.src" :alt="image.image.name" class="w-100" >
                        </picture>



                    </swiper-slide>


                </swiper>

                <div class="flex-center mt-5">
                    <p>Забронируйте прямо сейчас в один клик</p>
                </div>
                <div class="flex-center column mt-4 gab-20 pb-5 z-10 relative">
                    <Btn :btn="{
                  method:'method',
                  route:'singBron',
                  view:'btn-default'
              }">ЗАБРОНИРОВАТЬ</Btn>
                    <Btn :btn="{
              method:'method',
              route:'singBron',
              view:'btn-white'
              }">ОБРАТНЫЙ ЗВОНОК</Btn>
                </div>
            </div>
        </div>

    </div>
</template>

<script>


import {Swiper, SwiperSlide} from 'swiper/vue';

import {Autoplay} from 'swiper/modules';

export default {
    name: "index",
    components: {Swiper, SwiperSlide},
    props: {
        data: Object,
    },
    data() {
        return {
            modules:[Autoplay]
        }
    },
    methods: {

        isEven(number){
            return number % 2 !== 0
        },
        getField(name) {
            return this.data.fields.find(item => item.space === name)
        }
    },
    mounted() {

    },

}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';
.absolute{
    top: 0;
    left: 0;
    z-index: 10;
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    @include adaptiv-font(150, 36);
    line-height: 280px;

    color: rgba(255, 255, 255, 0.5);
}
p{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    @include adaptiv-font(26, 22);
    line-height: 32px;
    text-align: center;

    color: #FFFFFF;
}
img{
    border-radius: 20px;
    aspect-ratio:27/43;
}
.bg-bron{
    height: 100%;
    width: 100%;

    &:before {
        content: '';
        display: block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, .7);
        z-index: 5;
    }
}

</style>
