<template>


    <div :class="this.appendClass(data.view)" :id="`id-${data.id}`">
        <div id="reviews" class="bg-reviews relative pb-3 pt-5"
             :style="`background: url(${getField('bg-image').image.webp}) 0% 0% / cover no-repeat;`">

            <div class="container z-10 relative">
                <div class="row mb-3">
                    <div class="col-md-6 col-12">
                        <h2 class="h2">{{ getField('title').text }}</h2>
                    </div>

                </div>
                <div v-if="this.storage.width > 767" class="relative">
                    <swiper v-if="getField('collect-images').resource.data"
                            :slidesPerView="1"
                            :space-between="10"
                            :autoplay="{
                                      delay: 5000,
                                      disableOnInteraction: true,
                                    }"
                            :scrollbar="{
      hide: true,
    }"
                            :navigation="{nextEl:'.arrow-review-next',prevEl:'.arrow-review-prev'}"
                            :modules="modules"


                            class="my-swiper relative "

                    >
                        <swiper-slide class="relative " v-for="item in chunkArray(getField('collect-images').resource.data,8)">

                            <div class="row" >
                                <div class="col-md-3 mb-3"  v-for="it in item">
                                    <div class="image" :style="`background: url(${it.images[0].webp}) 50% / cover  no-repeat;`"
                                         @click="openImage(it.images)"></div>

                                </div>


                            </div>

                        </swiper-slide>


                    </swiper>
                    <div class="arrow-review-prev absolute flex-center m-hidden-lg">

                        <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.75 1L1.75 8L8.75 15" stroke="#ffffff" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                    </div>
                    <div class="arrow-review-next absolute flex-center m-hidden-lg">
                        <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.75 1L1.75 8L8.75 15" stroke="#ffffff" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>


                    </div>
                </div>
                <template v-else>
                    <swiper v-if="getField('collect-images').resource.data"
                            :slidesPerView="1.2"
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
                        <swiper-slide class="relative " v-for="item in getField('collect-images').resource.data">

                            <div class="row" >
                                <div class="col-12 "  >
                                    <div class="image" :style="`background: url(${item.images[0].webp}) 50% / cover  no-repeat;`"
                                         @click="openImage(item.images)"></div>

                                </div>


                            </div>

                        </swiper-slide>


                    </swiper>
                </template>

            </div>


        </div>


    </div>
    <FsLightbox v-if="images.length > 0"
                :toggler="toggler"
                :sources="images"
    />
</template>

<script>
import FsLightbox from "fslightbox-vue";
import {Swiper, SwiperSlide} from 'swiper/vue';

import {Autoplay, Scrollbar, Navigation, Pagination} from 'swiper/modules';
export default {
    components:{
        FsLightbox,Swiper, SwiperSlide
    },
    name: "index",
    props: {
        data: Object,
    },
    data() {
        return {
            toggler:false,
            images:[],
            modules: [Autoplay, Scrollbar,Navigation],
        }
    },
    methods: {
         chunkArray(array, size) {

             return Array.from({length: Math.ceil(array.length / size)}, (_, index) =>
                 array.slice(index * size, index * size + size)
             )

         },
        openImage(images){
            this.images = images.map(item =>{
                return item.webp
            })
            console.log(this.images)
            this.toggler = !this.toggler
        },
        async getResource(resource) {

            await axios.get(`/api/v1/${resource.resource.route}`, {
                params: resource.resource.filters
            }).then(data => {

                resource.resource.data = data.data.data

                this.images = resource.resource.data[0].images.map(item =>{
                    return item.webp
                })

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

        if (resource && resource.length > 0) {

            for (let i = 0; i < resource.length; i++) {

                this.getResource(resource[i])
            }
        }


    },

}
</script>

<style scoped lang="scss">
.arrow-review-prev,.arrow-review-next{
    top: calc(50% - 18px);
    z-index: 5;
    cursor: pointer;
    //border-radius:50%;
    //border: 1.75px solid #EDEDED;
    //background: #D9D9D9;
    //opacity: 0.85;
    height: 40px;
    width: 40px;

}
.arrow-review-prev{
    left: -50px;
}
.arrow-review-next{
    right: -50px;
    svg{
        transform:rotate(180deg);
    }
}
.swiper-button-disabled{
    display: none;
}
.bg-reviews {
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
.image{
    aspect-ratio:266/266;

    border-radius: 15px;

}
.h2{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 36px;
    line-height: 50px;
    text-transform: uppercase;
    color: #FFFFFF;
}
</style>
