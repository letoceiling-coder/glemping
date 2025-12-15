<template>


    <div :class="this.appendClass(data.view)" :id="`id-${data.id}`">
        <div class="bg-catalog relative pb-5 " v-if="this.$route.params.action"
             :style="`background: url(${getField('bg-image')?.image?.webp ?? ''}) 0% 0% / cover no-repeat;`">

            <div class=" z-10 relative">

                <OfferCard :offer="offer">

                </OfferCard>

                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-12  ">
                            <div class="widget flex column">
                                <h6 class="h6">Выберите удобный день для бронирования</h6>
                                <Widget/>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-12 ">
                            <div class="flex  gab-10 jc-center ai-center mt-3">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11" cy="11" r="11" fill="#00BA57"/>
                                </svg>
                                <p class="m-0">Сейчас этот домик смотрят {{getRandomInt(1,6)}} человек</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container mt-5" v-if="offer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-12  ">
                            <swiper :slidesPerView="1"
                                    :space-between="10"
                                    :autoplay="{
                                      delay: 5000,
                                      disableOnInteraction: true,
                                    }"
                                    :scrollbar="{
      hide: true,
    }"

                                    :modules="modules"


                                    class="my-swiper relative "

                            >
                                <swiper-slide v-for="image in offer.images" class="relative "
                                              @click="toggler = !toggler">
                                    <div class="w-100 as-ratio"
                                         :style="`background: url(${image.webp}) 50% / cover  no-repeat ;`"></div>


                                </swiper-slide>


                            </swiper>

                        </div>
                        <div class="col-md-6 col-sm-12 col-12 pb-3 ">
                            <h2 class="h2">информация о ДОМИКЕ</h2>

                            <div class="info border-bottom pb-3" v-html="offer.info"></div>
                            <p class=" mt-3">Дополнительно:</p>


                            <div class="info border-bottom pb-3" v-html="offer.additionally"></div>

                            <p class=" mt-3">Отмена менее чем за 10 дней — без возврата денежных средств</p>
                        </div>
                    </div>
                </div>
                <div class="bottom-option absolute p-5" v-if="offer">
                    <div class="row ">
                        <div class="col-md-6 col-sm-12 col-12"></div>
                        <div class="col-md-6 col-sm-12 col-12 ">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-12 mb-3" v-for="option in offer.options_info">
                                    <div class="options_info flex gab-10">
                                        <img :src="option.image_id.webp" alt="">
                                        <span>{{ option.name }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="bg-catalog relative pb-2 pt-2" v-else
             :style="`background: url(/img/background-catalog.png) 0% 0% / cover no-repeat;`">

            <div class="container z-10 relative">
                <Breadcrumbs :offer="offer"/>
                <div class="row mt-4">
                    <div class="col-md-4 col-12" v-for="item in getField('collect-offers').resource.data">
                        <router-link :to="item.slug">
                            <Offer :house="item"/>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <FsLightbox v-if="offer"
                :toggler="toggler"
                :sources="offer.images.map(item =>{
                return item.webp
            })"
    />
</template>

<script>
import {Swiper, SwiperSlide} from 'swiper/vue';

import {Autoplay, Scrollbar, Navigation, Pagination} from 'swiper/modules';
import Breadcrumbs from '/resources/js/src/Views/Breadcrumbs/index.vue'
import Offer from '/resources/js/src/Views/Cards/Offer/index.vue'
import OfferCard from '/resources/js/src/Views/Template/Catalog/components/offer-card.vue'
import Widget from '/resources/js/src/Views/components/widget.vue'
import 'swiper/css/scrollbar';
import FsLightbox from "fslightbox-vue";

export default {
    props: {
        data: Object,
    },
    components: {
        Breadcrumbs, Offer, OfferCard, Widget, Swiper, SwiperSlide, FsLightbox
    },
    mounted() {
        let resource = this.data.fields.filter(item => item.type == 'resource')

        if (resource && resource.length > 0) {

            for (let i = 0; i < resource.length; i++) {

                this.getResource(resource[i])
            }
        }
        if (!this.$route.params.action){
            lpmsrid = undefined
        }

    },
    methods: {
        getRandomInt(min, max) {
            min = Math.ceil(min); // округляем до ближайшего большего целого
            max = Math.floor(max); // округляем до ближайшего меньшего целого
            return Math.floor(Math.random() * (max - min + 1)) + min; // генерируем случайное целое число
        },
        async getResource(resource) {

            await axios.get(`/api/v1/offers`, {
                params: resource.resource.filters
            }).then(data => {

                resource.resource.data = data.data.data
                this.offer = this.getField('collect-offers').resource.data.find(item => item.slug == `/catalog/${this.$route.params.action}`)
                this.storage.offer = this.offer
            }).catch((error) => {
                console.log(error)

            })

        },
        getField(name) {
            return this.data.fields.find(item => item.space === name)
        }
    },
    data() {
        return {
            offer: null,
            modules: [Autoplay, Scrollbar],
            toggler: false
        }
    }
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';

.my-swiper {
    cursor: pointer;
}

.as-ratio {
    aspect-ratio: 53/45;
    border-radius: 20px;
}

.options_info {
    img {
        width: 40px;
        height: 40px;
        border-radius: unset;
    }
}

.bottom-option {
    width: 100%;
    bottom: -3rem;

    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);

    span {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        @include adaptiv-font(14, 12);
        line-height: 20px;
        /* or 143% */
        display: flex;
        align-items: center;

        color: #FFFFFF;
    }

}

@media only screen and (max-width: 767px) {
    .bottom-option {
        position: relative !important;
    }
}

.h2 {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    @include adaptiv-font(32, 22);
    line-height: 50px;
    text-transform: uppercase;
    color: #FFFFFF;
}

.h6 {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 700;
    @include adaptiv-font(20, 18);
    text-align: center;
    line-height: 28px;
    /* identical to box height, or 127% */
    display: flex;
    align-items: center;
    letter-spacing: 0.19898px;

    color: #FFFFFF;
}

img {
    border-radius: 20px;
    aspect-ratio: 53/45;
}

.bg-catalog {

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
        background-color: rgba(0, 0, 0, .5);
        z-index: 5;
    }
}

p {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    @include adaptiv-font(14, 12);
    line-height: 17px;

    color: #FFFFFF;
}

@media only screen and (max-width: 767px) {

}

</style>
