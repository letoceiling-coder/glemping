<template>

    <div class="row card">
        <div class="card-header">
            <label>{{ setting.label }}</label>
        </div>
        <div class="col-12 card-body flex ai-center gab-20">
            <div class="form-group">

                <mc-btn-image v-model="setting.image" keys="image"
                              :countFile="setting.settings?.countFile"></mc-btn-image>

            </div>

            <div class="images" v-if="setting.image.length > 0">
                <swiper :slidesPerView="setting.image.length == 1 ? 1 : 1.2"
                        :space-between="setting.image.length == 1 ? 0 : 10"
                        :style="`aspect-ratio:${setting.settings.ratio}`"
                        class="mySwiper w-100 mb-3"

                >
                    <swiper-slide v-for="image in setting.image">

                        <img :src="image.src" :alt="image.name" class="w-100">


                    </swiper-slide>
                </swiper>

            </div>
        </div>
    </div>
</template>

<script>
import {Swiper, SwiperSlide} from 'swiper/vue';

import 'swiper/css';
export default {
    components:{
        Swiper, SwiperSlide
    },
    props: {
        setting: Object
    }
}
</script>

<style scoped>
.images{
    max-width: 150px;
}
</style>
