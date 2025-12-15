<template>

    <div  :class="this.appendClass(data.view)" :id="`id-${data.id}`">
        <div id="fag" class="bg-faq relative pb-3 pt-5" :style="`background: url(${getField('bg-image').image.webp}) 0% 0% / cover no-repeat;`">
            <div class="container z-10 relative">
                <div class="row flex jc-sb ai-center">
                    <div class="col-md-6 col-12">
                        <h2 class="h2">{{getField('title').text}}</h2>
                    </div>


                </div>

                <div class="row  mt-4 align-items-center">
                    <div class="col-md-6 col-12 flex column jc-sb gab-20">
                        <div class="card-blur p-4" v-for="section in getField('faq').data">
                            <div class="flex jc-sb ai-center cursor-pointer" @click="openAnswer($event)">
                                <div class="question">
                                    {{section.question}}
                                </div>
                                <svg :class="section.active ? 'rotate':''" width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_230_3650" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="11" height="12">
                                        <rect x="10.9831" y="0.949219" width="10.9398" height="10.9398" transform="rotate(90 10.9831 0.949219)" fill="#D9D9D9"/>
                                    </mask>
                                    <g mask="url(#mask0_230_3650)">
                                        <path d="M0.954872 8.24186L5.51314 3.68359L10.0714 8.24186L9.26232 9.05096L5.51314 5.30178L1.76396 9.05096L0.954872 8.24186Z" fill="white"/>
                                    </g>
                                </svg>

                            </div>

                            <div class="answer mt-4" :style="section.active ? 'display:block':'display:none'">
                                {{section.answer}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <picture >
                            <source :srcset="getField('image').image.webp"
                                    type="image/webp">
                            <img :src="getField('image').image.src" :alt="getField('image').image.name" class="w-100">
                        </picture>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>


export default {
    name: "index",

    props: {
        data: Object,
    },
    data() {
        return {

        }
    },
    methods: {

        openAnswer(e){
            $(e.target).closest('.card-blur').find('.answer').slideToggle()
            $(e.target).find('svg').toggleClass('rotate')
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
img{
    border-radius: 15px;
    @media only screen and (max-width: 767px) {
        &{
            margin-top: 1rem;
        }
    }
}
.rotate{
    transform:rotate(180deg);
}
.card-blur{
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(25.7297px);
    border-radius: 20px;
    .question{
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        @include adaptiv-font(16, 14);
        line-height: 22px;

        color: #FFFFFF;
    }
    .answer{
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 500;
        @include adaptiv-font(12, 12);
        line-height: 15px;

        color: rgba(255, 255, 255, 0.9);
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

.bg-faq{
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
