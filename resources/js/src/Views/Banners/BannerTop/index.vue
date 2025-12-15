<template>

    <div  :class="this.appendClass(data.view)" :id="`id-${data.id}`">
        <div class="bg-section relative pb-3 pt-5" :style="`background: url(${getField('bg-image').image.webp}) 0% 0% / cover no-repeat;`">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-8 col-md-7  special-swiper mt-3 ">
                        <SwiperBig :data="getField('special_offers').resource.data"/>

                    </div>
                    <div class="col-lg-4 col-md-5 relative special-swiper mt-3  flex column jc-sb">
                        <div >
                            <swiper :slidesPerView="1"
                                    :space-between="10"
                                    :pagination="{
                                    clickable: true,
                                }"


                                    :modules="modules"
                                    class="my-swiper "


                            >
                                <swiper-slide v-for="houses in getField('collect-stocks').resource.data">

                                   <router-link :to="houses.slug" v-if="houses.slug">
                                       <div class="image-card relative w-100"
                                            :style="`background: url(${houses.image_id.webp}) 50% / cover no-repeat;`"
                                       >


                                       </div>
                                   </router-link>
                                    <div v-else class="image-card relative w-100"
                                         :style="`background: url(${houses.image_id.webp}) 50% / cover no-repeat;`"
                                    >


                                    </div>


                                </swiper-slide>
                            </swiper>
                        </div>

                        <Widget></Widget>
<!--                        <div class="row  mt-3" v-if="getField('collect-offers').resource.data">-->

<!--                            <div class="col-12 flex gab-20 m-show-flex" >-->

<!--                                <router-link :to="house.slug" v-for="house in getField('collect-offers').resource.data.slice(0, 2)" class="w-100">-->

<!--                                    <div class="image-house relative  w-100"-->
<!--                                         :style="`background: url(${house.images[0].webp}) 0% 0% / cover no-repeat;`">-->
<!--                                        <div class="absolute flex column jc-sb h-90 top-0 left-0 pl-3 w-100" >-->
<!--                                            <div class="flex justify-content-end ">-->
<!--                                                <div class="bg-radius flex-center">-->
<!--                                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"-->
<!--                                                         xmlns="http://www.w3.org/2000/svg">-->
<!--                                                        <path-->
<!--                                                            d="M9.3617 0.274811H0.638286C0.437648 0.274811 0.274811 0.437648 0.274811 0.638286C0.274811 0.838925 0.437648 1.00176 0.638286 1.00176H8.48409L0.381309 9.10472C0.239372 9.24666 0.239372 9.47674 0.381309 9.61868C0.452369 9.68974 0.545237 9.72517 0.638286 9.72517C0.731336 9.72517 0.824386 9.68974 0.895263 9.61868L8.99822 1.51572V9.3617C8.99822 9.56234 9.16106 9.72517 9.3617 9.72517C9.56234 9.72517 9.72517 9.56234 9.72517 9.3617V0.638286C9.72517 0.437648 9.56234 0.274811 9.3617 0.274811Z"-->
<!--                                                            fill="#222222"/>-->
<!--                                                    </svg>-->
<!--                                                </div>-->


<!--                                            </div>-->
<!--                                            <div class="title-smol ">-->
<!--                                                {{house.name}}-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->

<!--                                </router-link>-->
<!--                            </div>-->


<!--                        </div>-->

                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import Widget from '/resources/js/src/Views/components/widget.vue'
import {Swiper, SwiperSlide} from 'swiper/vue';

import {Autoplay, Scrollbar, Navigation, Pagination} from 'swiper/modules';

import SwiperBig from './components/swiperBig.vue'

export default {
    components: {Swiper, SwiperSlide,SwiperBig,Widget},
    name: "index",
    props: {
        data: Object,
    },
    data() {
        return {
            resources: {
                menus:[]
            },
            phone:'',
            modules: [Autoplay, Pagination, Scrollbar, Navigation],

        }
    },
    methods: {
        sendPhone(){

        },
        showImage(){

        },
        showVideo(){

        },
        async getResource(resource) {

            await axios.get(`/api/v1/${resource.resource.route}`, {
               params:resource.resource.filters
            }).then(data => {

                resource.resource.data = data.data.data

            }).catch((error) => {
                console.log(error)

            })

        },
        getField(name) {
            return this.data.fields.find(item => item.space === name)
        }
    },
    mounted() {
        let resource = this.data.fields.filter(item => item.type == 'resource')

        if (resource && resource.length > 0){

            for (let i = 0; i < resource.length; i++) {

                this.getResource(resource[i])
            }
        }




    },

}
</script>

<style>
.swiper-pagination {
    text-align: right!important;
    padding-right: 20px!important;
}

.swiper-pagination-bullet {
    background: #fff!important;
    opacity: 1!important;
}

.swiper-pagination-bullet-active {

    background: #00BA57!important;
}
.bg-radius-white{
    width: 32px;
    height: 32px;
    background: #fff;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
}
.h-90{
    height: 90%;
}
</style>
<style scoped lang="scss">
.right-0{
    right: -1px;
}
.properties{
    span{
        background: #00BA57;
        backdrop-filter: blur(1.3119px);
        border-radius: 13.119px;
        height: 32px;
        padding: 0 15px;
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 600;
        font-size: 10px;
        line-height: 12px;

        color: #FFFFFF;
    }
}

.title-smol{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 17px;
    color: #FFFFFF;
}
.title{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    font-size: 30px;
    line-height: 37px;
    color: #FFFFFF;
}

.smoll-swiper{
    top: 15px;
    left: 15px;
    width: calc(100% - 30px);
}
.bg-radius {
    width: 26px;
    height: 26px;
    background: #FFFFFF;
    border-radius: 78.753px;
    margin-right: 10px;
    margin-top: 10px;
}

.image-house {
    aspect-ratio: 185/143;
    border-radius: 20px;
}

.label-desc {

    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 15px;
    color: #222222;

    opacity: 0.75;
}

.label-text {

    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    font-size: 12.5678px;
    line-height: 15px;

    color: #222222;
}

.my-swiper, .card {
    border-radius: 20px;
}

h2 {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    font-size: 60px;
    line-height: 60px;

    color: #FFFFFF;


}


.image-card {
    aspect-ratio: 1/1;
    border-radius: 20px;
}

.special-swiper {
    z-index: 10;
    //aspect-ratio: 68/48;

}

.bg-section {

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
</style>
