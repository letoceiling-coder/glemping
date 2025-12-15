<template>

    <div :class="this.appendClass(data.view)" :id="`id-${data.id}`">
        <swiper :slidesPerView="1"
                :pagination="true"
                :space-between="10"
                :autoplay="{
              delay: 5000,
              disableOnInteraction: true,
            }"
                :navigation="{nextEl:'.arrow-next',prevEl:'.arrow-prev'}"
                :modules="modules"
                class="mySwiper w-100 relative"
                v-if="resources.banner_swipers"
        >
            <swiper-slide v-for="item in resources.banner_swipers">
                <a v-if="item.slug?.includes('://')" :href="item.slug" class="w-100 flex img-container" target="_blank">
                    <img :style="ratio ? getRatio(ratio) : ''" :src="this.storage.width > 767 ? item.image_d_id.webp :  item.image_m_id.webp " :alt="this.storage.width > 767 ? item.image_d_id.name:item.image_m_id.name" loading="lazy" class="w-100">
                </a>

                <router-link v-else-if="item.slug" :to="item.slug" class="w-100 flex img-container">
                    <img :style="ratio ? getRatio(ratio) : ''" :src="this.storage.width > 767 ? item.image_d_id.webp :  item.image_m_id.webp " :alt="this.storage.width > 767 ? item.image_d_id.name:item.image_m_id.name" loading="lazy" class="w-100">
                </router-link>
                <div v-else class="w-100 flex img-container">
                    <img :style="ratio ? getRatio(ratio) : ''" :src="this.storage.width > 767 ? item.image_d_id.webp :  item.image_m_id.webp " :alt="this.storage.width > 767 ? item.image_d_id.name:item.image_m_id.name" loading="lazy" class="w-100">

                </div>


            </swiper-slide>

            <div class="arrow-prev absolute flex-center m-hidden-lg">

                <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.75 1L1.75 8L8.75 15" stroke="#000000" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

            </div>
            <div class="arrow-next absolute flex-center m-hidden-lg">
                <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.75 1L1.75 8L8.75 15" stroke="#000000" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>


            </div>
        </swiper>
    </div>
</template>

<script>
import {Swiper, SwiperSlide} from 'swiper/vue';
import 'swiper/css/pagination';
import {Pagination,Navigation,Autoplay} from 'swiper/modules';
import 'swiper/css';

export default {
    components: {
        Swiper, SwiperSlide
    },
    name: "index",
    props: {
        data: Object,
    },
    data() {
        return {
            resources: {

            },
            modules: [Pagination,Navigation,Autoplay],
            ratio: null,

        }
    },
    methods: {
        getRatio(ratio){

            let aspect;

            if (this.storage.width > 767){

                 aspect = `aspect-ratio:${ratio.descTop.numerator} / ${ratio.descTop.denominator}`

            }else {
                 aspect = `aspect-ratio:${ratio.mobile.numerator} / ${ratio.mobile.denominator}`

            }

            return aspect
        },
        async getResource(resource) {
            resource.resource.filters.active = true
            await axios.get(`/api/v1/${resource.resource.route}`, {
               params:resource.resource.filters
            }).then(data => {

                this.resources[resource.resource.route] = data.data.data

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
        this.ratio = this.data.fields.find(item => item.type == 'ratio')

        if (resource && resource.length > 0){
            for (let i = 0; i < resource.length; i++) {

                this.getResource(resource[i])
            }
        }




    },

}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';

.img-container {

    border-radius: 35px;
    overflow: hidden;
    img {
        //aspect-ratio: 3/1;



    }

}

@media only screen and (max-width: 767px) {
    .img-container {

        img {
            //aspect-ratio: 1/1;

        }

    }
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
    background: #D9D9D9;
    opacity: 0.85;
    height: 40px;
    width: 40px;

}
.arrow-prev{
    left: 25px;
}
.arrow-next{
    right: 25px;
    svg{
        transform:rotate(180deg);
    }
}

@media only screen and (max-width: 767px) {
    .btn-favourites,.arrow-next,.arrow-prev{
        display: none;
    }

}
</style>
