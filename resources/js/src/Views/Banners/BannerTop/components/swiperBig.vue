<template>
    <swiper :slidesPerView="1"
            :space-between="10"
            :autoplay="{
                                      delay: 5000,
                                      disableOnInteraction: true,
                                    }"
            :pagination="{
                clickable: true,
            }"
            :modules="modules"
            class="my-swiper relative"

    >
        <swiper-slide v-for="special in data" class="relative">
            <router-link :to="special.offer.slug">
                <div class="image relative w-100  "
                     :style="`background: url(${special.offer.images[0].webp}) 0% 0% / cover no-repeat;`"
                >
                </div>
                <div class="info-special absolute flex column jc-sb h-100">
                    <div class="row">
                        <div class="col-md-7 col-12 flex-wrap gab-10">

                            <span class="label" v-for="property in special.offer.properties_info">{{ property.name }}</span>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-11">
                            <h2>{{ special.title }}</h2>
                        </div>
                    </div>


                </div>
            </router-link>




        </swiper-slide>
        <div class="col-md-5 d-none d-md-block p-0 absolute absolute-phone">
            <div class="block-blur flex column p-3">
                <p>Закажите обратный звонок, чтобы получить консультацию</p>
                <form class="relative">
                    <mc-phone v-model="$parent.phone" keys="form.phone" class="form-control form-phone"/>
                    <div @click="$parent.sendPhone" class="absolute radius-green flex-center top-0 right-0" >
                        <svg  width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.2071 8.70711C16.5976 8.31658 16.5976 7.68342 16.2071 7.29289L9.84315 0.928933C9.45262 0.538409 8.81946 0.538409 8.42893 0.928933C8.03841 1.31946 8.03841 1.95262 8.42893 2.34315L14.0858 8L8.42893 13.6569C8.03841 14.0474 8.03841 14.6805 8.42893 15.0711C8.81946 15.4616 9.45262 15.4616 9.84315 15.0711L16.2071 8.70711ZM0.5 8L0.5 9L15.5 9L15.5 8L15.5 7L0.5 7L0.5 8Z" fill="white"/>
                        </svg>
                    </div>

                </form>
            </div>
        </div>

    </swiper>

</template>

<script>
import {Swiper, SwiperSlide} from 'swiper/vue';

import {Autoplay, Scrollbar, Navigation, Pagination} from 'swiper/modules';

export default {
    name: "swiperBig",
    components: {Swiper, SwiperSlide},
    props: {
        data: Object
    },
    data() {
        return {

            modules: [Autoplay, Pagination, Scrollbar, Navigation],
        }
    }
}
</script>
<style lang="scss">
.form-phone{

    box-sizing: border-box;

    background: #FFFFFF;
    border-width: 0.817346px 0px 0.817346px 0.817346px;
    border-style: solid;
    border-color: #FFFFFF;
    border-radius: 20px;

}

.radius-green{
    width: 38px;
    height: 38px;
    background: #00BA57;
    border-radius: 80px;
    cursor: pointer;
}
.top-0 {
    top: 0;
}
.right-0{
    right: 0;
}
</style>
<style scoped lang="scss">
@import '/resources/css/mixin.scss';
.absolute-phone{
    top: 20px;
    right: 20px;
    z-index: 1;
}
.block-blur{

    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(2.5px);
    border-radius: 12px;
p{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    @include adaptiv-font(16, 12);
    line-height: 22px;

    color: #FFFFFF;
}
}
h2 {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;

    @include adaptiv-font(60, 26);
    line-height: 60px;

    color: #FFFFFF;
    @media only screen and (max-width: 767px) {
        &{
            line-height: 36px;
        }
    }

}

.my-swiper {
    border-radius: 20px;
}

.label {

    background: #00BA57;
    backdrop-filter: blur(2px);

    border-radius: 20px;
    padding: 8px 30px;
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    @include adaptiv-font(12, 12);

    line-height: 15px;

    color: #FFFFFF;
}

.info-special {
    top: 0;
    left: 0;
    width: 100%;
    padding: 25px;
}

.image {

    aspect-ratio: 680/545;

    border-radius: 20px;
    @media only screen and (max-width: 767px) {
        &{
            height: 380px
        }
    }

}
</style>
