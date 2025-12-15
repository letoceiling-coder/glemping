<template>

    <div  :class="this.appendClass(data.view)" :id="`id-${data.id}`"  v-if="getField('collect-offers').resource.data">
        <div id="houses" class="bg-section relative pb-3 pt-5"
             :style="`background: url(${getField('bg-image').image.webp}) 0% 0% / cover no-repeat;`">
            <div class="container z-10 relative">
                <div class="row flex jc-sb ai-center">
                    <div class="col-md-6 col-12">
                        <h2 class="h2">{{ getField('title').text }}</h2>
                    </div>


                </div>

                <div class="row" >
                    <div class="col-md-4 col-12 mb-3 p-2"
                         v-for="(house,index) in getField('collect-offers').resource.data.slice(0,limit)" :key="index"
                         v-auto-animate>
                        <router-link :to="house.slug">
                            <Offer :house="house"></Offer>
                        </router-link>

                    </div>
                </div>

                <div class="row" v-if="getField('collect-offers').resource.data.length >= limit">
                    <div class="col-12 flex-center">
                   <span>
                        <Btn :btn="{view:'btn-white',route:'addLimit',method:'method'}">Смотреть все</Btn>
                   </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>


import Offer from '/resources/js/src/Views/Cards/Offer/index.vue'

export default {
    components: {Offer},
    name: "index",
    props: {
        data: Object,
    },
    data() {
        return {

            limit: 6,
        }
    },
    methods: {
        addLimit() {

            this.limit = this.limit + 6

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

<style>
.swiper-pagination {
    text-align: right !important;
    padding-right: 20px !important;
}

.swiper-pagination-bullet {
    background: #fff !important;
    opacity: 1 !important;
}

.swiper-pagination-bullet-active {

    background: #00BA57 !important;
}

.bg-radius-white {
    width: 32px;
    height: 32px;
    background: #fff;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
}

.h-90 {
    height: 90%;
}
</style>
<style scoped lang="scss">
.h2{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 36px;
    line-height: 50px;

    color: #FFFFFF;
}
.right-0 {
    right: -1px;
}

.properties {
    span {
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

.title-smol {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 17px;
    color: #FFFFFF;
}

.title {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    font-size: 30px;
    line-height: 37px;
    color: #FFFFFF;
}

.smoll-swiper {
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
    aspect-ratio: 385/215;
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
