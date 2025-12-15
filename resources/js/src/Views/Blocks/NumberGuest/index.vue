<template>



    <div  :class="this.appendClass(data.view)" :id="`id-${data.id}`" >
        <div class="bg-guest relative pb-3 pt-5" :style="`background: url(${getField('bg-image').image.webp}) 0% 0% / cover no-repeat;`">
            <div class="container z-10 relative" >
                <div class="row">
                    <div class="col-12 flex column justify-content-around">
                        <h3 class="pt-5">{{getField('title').text}}</h3>
                        <div class="guest">{{getField('guest').data.guest.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}}</div>
                        <div class="slogan pb-5">Гостей побывало у нас</div>
                    </div>
                </div>

            </div>


        </div>


    </div>
</template>

<script>

import Services from '/resources/js/src/Views/Cards/Services/index.vue'
export default {
    components: {Services},
    name: "index",
    props: {
        data: Object,
    },
    data() {
        return {


        }
    },
    methods: {


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
h3{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    @include adaptiv-font(30, 22);
    line-height: 50px;
    /* or 167% */
    text-align: center;
    text-transform: uppercase;

    color: #FFFFFF;
    @media only screen and (max-width: 767px) {
        &{
            line-height: 35px;
        }
    }
}

.guest{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    @include adaptiv-font(120, 80);
    line-height: 146px;
    text-align: center;

    color: #00BA57;
    @media only screen and (max-width: 767px) {
        &{
            line-height: 80px;
        }
    }
}
.slogan{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    @include adaptiv-font(24, 18);
    line-height: 29px;
    text-align: center;

    color: #FFFFFF;
}
.bg-guest{
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
