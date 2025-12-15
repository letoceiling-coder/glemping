<template>

    <div  :class="this.appendClass(data.view)" :id="`id-${data.id}`" v-if="getField('collect-include').resource.data">
        <div id="includes" class="bg-included relative pb-3 pt-5" :style="`background: url(${getField('bg-image')?.image?.webp}) 0% 0% / cover no-repeat;`">
            <div class="container z-10 relative" v-if="this.storage.width > 767">
                <div class="row flex jc-sb ai-center">
                    <div class="col-md-6 col-12">
                        <h2 class="h2">{{ getField('title').text }}</h2>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="flex gab-10 ai-center float-right ">
                            <div class="bg-radius-white flex-center cursor-pointer arrow-next">
                                <svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.09916 5.00015L12.9007 5.00015" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.31403 0.7854L1.09918 5.00024" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.31403 9.21509L1.09918 5.00024" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                            <div class="bg-radius-white flex-center cursor-pointer arrow-prev">
                                <svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.9008 4.99985H1.09924" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.68597 9.2146L12.9008 4.99976" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.68597 0.784912L12.9008 4.99976" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" v-if="getField('collect-include').resource.data">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12" v-auto-animate>
                                        <div class="image relative w-100  "
                                             :style="`background: url(${getField('collect-include')?.resource?.data[slide]?.image_id?.webp ?? ''}) 0% 0% / cover no-repeat;`"
                                        >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12" v-if="getField('collect-include')?.resource?.data[slide]">
                                        <div class="flex column">
                                            <div class="title">{{getField('collect-include')?.resource?.data[slide].title}}</div>
                                            <div class="description">{{getField('collect-include')?.resource?.data[slide].description}}</div>

                                            <div class="properties " >
                                                <div class="card-grey mt-4 flex gab-10" >
                                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="0.52655" y="0.115479" width="26.975" height="26.975" rx="13.4875" fill="#00BA57"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6167 9.27174L11.9319 10.9566C11.7711 11.1173 11.7231 11.359 11.81 11.569C11.897 11.779 12.1019 11.9159 12.3292 11.9159H15.6989C15.9261 11.9159 16.131 11.779 16.218 11.569C16.305 11.359 16.2569 11.1173 16.0962 10.9566L14.4114 9.27178C14.192 9.05232 13.8362 9.05231 13.6167 9.27174Z" stroke="white" stroke-width="0.842969" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M12.1341 11.8794L10.8079 13.2056C10.6472 13.3663 10.5991 13.608 10.6861 13.818C10.7731 14.028 10.978 14.165 11.2053 14.165H16.8228C17.0501 14.165 17.255 14.028 17.342 13.818C17.429 13.608 17.3809 13.3663 17.2202 13.2056L15.8939 11.8794" stroke="white" stroke-width="0.842969" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M14.857 16.9749V18.6608" stroke="white" stroke-width="0.842969" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M13.1711 18.6608V16.9749" stroke="white" stroke-width="0.842969" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M15.7 18.6609H12.3281" stroke="white" stroke-width="0.842969" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M11.5345 14.165L9.68396 16.0156C9.52324 16.1763 9.47516 16.418 9.56214 16.628C9.64912 16.838 9.85403 16.9749 10.0813 16.9749H17.9468C18.1741 16.9749 18.379 16.838 18.466 16.628C18.5529 16.418 18.5049 16.1763 18.3441 16.0156L16.4936 14.165" stroke="white" stroke-width="0.842969" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>

                                                    <div class="flex column gab-15">
                                                        <span class="enabled">ВКЛЮЧЕНО:</span>
                                                        <span class="enabled-text">{{ getField('collect-include')?.resource?.data[slide].enabled }}</span>

                                                    </div>
                                                </div>
                                                <div class="card-grey mt-4 flex gab-10" >
                                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="0.52652" y="0.206299" width="26.975" height="26.975" rx="13.4875" fill="#00BA57"/>
                                                        <path d="M17.014 8.11469C16.0922 7.61784 15.0612 7.35858 14.014 7.36036C10.5163 7.36036 7.68068 10.196 7.68068 13.6937C7.68068 17.1914 10.5163 20.027 14.014 20.027C14.9351 20.0287 15.8454 19.8283 16.6807 19.44" stroke="white" stroke-width="1.33333" stroke-linecap="round"/>
                                                        <path d="M16.3473 15.6937H20.3473M11.014 13.027L13.3473 15.3604L19.6807 9.36035M18.3473 13.6937V17.6937" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>


                                                    <div class="flex column gab-15">
                                                        <span class="enabled">ДОПОЛНИТЕЛЬНО:</span>
                                                        <span class="enabled-text">{{ getField('collect-include')?.resource?.data[slide].additionally }}</span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <swiper :slidesPerView="2"
                                :space-between="10"
                                :autoplay="{
                                      delay: 5000,
                                      disableOnInteraction: true,
                                    }"
                                :pagination="{clickable: true}"
                                :modules="modules"
                                :navigation="{nextEl:'.arrow-next',prevEl:'.arrow-prev'}"
                                @swiper="onSwiper"
                                @slideChange="onSlideChange"
                                class="my-swiper relative m-4"

                        >
                            <swiper-slide v-for="(image,index) in getField('collect-include')?.resource?.data" class="relative">

                                <div class="image relative w-100  cursor-pointer" @click="slide = index"
                                     :style="`background: url(${image?.image_id?.webp}) 0% 0% / cover no-repeat;`"
                                >
                                </div>


                            </swiper-slide>

                        </swiper>
                    </div>
                </div>
            </div>


            <div class="container z-10 relative" v-if="this.storage.width <= 767">
                <div class="row flex jc-sb ai-center">
                    <div class="col-md-6 col-12">
                        <h2 class="h2">{{ getField('title').text }}</h2>
                    </div>

                </div>
                <div class="card">
                    <div class="card-body p-0">
                        <div class="images-swiper relative">
                            <swiper :slidesPerView="1"
                                    :space-between="10"
                                    :autoplay="{
                                      delay: 5000,
                                      disableOnInteraction: true,
                                    }"
                                    :pagination="{clickable: true}"
                                    :modules="modules"
                                    :navigation="{nextEl:'.arrow-next',prevEl:'.arrow-prev'}"
                                    @swiper="onSwiper"
                                    @slideChange="onSlideChange"
                                    class="my-swiper relative m-4"

                            >
                                <swiper-slide v-for="image in getField('collect-include')?.resource?.data" class="relative">

                                    <div class="image relative w-100  "
                                         :style="`background: url(${image?.image_id?.webp}) 0% 0% / cover no-repeat;`"
                                    >

                                    </div>


                                </swiper-slide>

                            </swiper>
                            <div class="arrow-next bg-radius-white absolute arrow">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.09919 11.0001L16.9008 11.0001" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.31403 6.7854L5.09918 11.0002" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.31403 15.2151L5.09918 11.0002" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                            <div class="arrow-prev bg-radius-white absolute arrow">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.9008 10.9999H5.09924" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.686 15.2146L16.9008 10.9998" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.686 6.78491L16.9008 10.9998" stroke="black" stroke-width="1.26445" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                        </div>

                        <div class="flex column p-3" v-if="getField('collect-include')?.resource?.data[slide]">
                            <div class="title ">{{getField('collect-include')?.resource?.data[slide].title}}</div>
                            <div class="description mt-3">{{getField('collect-include')?.resource?.data[slide].description}}</div>
                        </div>
                    </div>

                </div>


            </div>
        </div>


    </div>
</template>

<script>



import {Swiper, SwiperSlide} from 'swiper/vue';

import {Autoplay, Scrollbar, Navigation, Pagination} from 'swiper/modules';
export default {
    components: {Swiper, SwiperSlide},
    name: "index",
    props: {
        data: Object,
    },
    data() {
        return {

            slide:0,
            modules: [Autoplay, Pagination, Scrollbar, Navigation],
        }
    },

    methods: {
        onSwiper(swiper){

        },
        onSlideChange(swiper){

            this.slide = swiper.activeIndex
        },
        async getResource(resource) {

            await axios.get(`/api/v1/${resource.resource.route}`, {
                params: resource.resource.filters
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

        if (resource && resource.length > 0) {

            for (let i = 0; i < resource.length; i++) {

                this.getResource(resource[i])
            }
        }


    },

}
</script>

<style  lang="scss">
.border-radius-green{
    width: 32px;
    height: 32px;
    background: #00BA57;
    border-radius: 100%;

}
</style>
<style scoped lang="scss">
@import '/resources/css/mixin.scss';
.arrow{
    top: calc(50% - 16px);
    z-index: 5;
    display: flex;
    justify-content: center;
    align-items: center;
}
.arrow-next{
    left: 8px;
    -webkit-box-shadow: 4px 4px 8px 0px rgba(34, 60, 80, 0.2) inset;
    -moz-box-shadow: 4px 4px 8px 0px rgba(34, 60, 80, 0.2) inset;
    box-shadow: 4px 4px 8px 0px rgba(34, 60, 80, 0.2) inset;
}
.arrow-prev{
    right: 8px;
    -webkit-box-shadow: -5px -5px 5px -5px rgba(34, 60, 80, 0.6) inset;
    -moz-box-shadow: -5px -5px 5px -5px rgba(34, 60, 80, 0.6) inset;
    box-shadow: -5px -5px 5px -5px rgba(34, 60, 80, 0.6) inset;
}
.card-grey{
    box-sizing: border-box;
    padding:  15px 8px;
    background: #FBFBFB;
    border: 0.842969px solid #EBEBEB;
    border-radius: 12px;
}
.enabled{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 17px;
    color: #000000;
}
.enabled-text{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 15px;

    color: #000000;
}
.title{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 27px;

    text-transform: uppercase;
    color: #000000;
}
.description{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 15px;

    color: #000000;
}
.card{
    border-radius:20px!important;
}
.image {

    aspect-ratio: 28/36;

    border-radius: 20px;
    @media only screen and (max-width: 767px) {
        &{

        }
    }

}

.bg-included {

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
.h2{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 36px;
    line-height: 50px;

    color: #FFFFFF;
}
</style>
