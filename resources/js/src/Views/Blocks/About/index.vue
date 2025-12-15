<template>

    <div  :class="this.appendClass(data.view)" :id="`id-${data.id}`" >
        <div id="about" class="bg-about relative pb-3 pt-5" :style="`background: url(${getField('bg-image').image.webp}) 0% 0% / cover no-repeat;`">
            <div class="container z-10 relative">
                <div class="row flex jc-sb ai-center">
                    <div class="col-md-6 col-12">
                        <h2 class="h2">{{ getField('title').text }}</h2>
                    </div>
                    <div class="col-md-6 col-12">
                        <p>{{getField('description').text}}</p>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 image">

                        <img :src="getField('info').data[0].image.webp" :alt="getField('info').data[0].image.name" class="w-100 border-radius ">

                    </div>
                    <div class="col-md-6 flex column justify-content-between">
                        <div class="row ">
                            <div class="col-md-6 m-auto" v-for="image in getField('info').data.slice(1,3)">
                                <div class="image relative">
                                    <img :src="image.image.webp" :alt="image.image.name" class="w-100 border-radius">
                                    <div class="absolute absolute-text">
                                        <div class="title">{{image.title}}</div>
                                        <div class="description">{{image.description}}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-6 m-auto" v-for="image in getField('info').data.slice(3)">

                                <div class="image relative">
                                    <img :src="image.image.webp" :alt="image.image.name" class="w-100 border-radius">
                                    <div class="absolute absolute-text">
                                        <div class="title">{{image.title}}</div>
                                        <div class="description">{{image.description}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
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


        getField(name) {
            return this.data.fields.find(item => item.space === name)
        }
    },
    mounted() {

    },

}
</script>

<style>
.z-10{
    z-index: 10;
}
.border-radius{

    background: linear-gradient(357.92deg, rgba(0, 0, 0, 0.7) 9.76%, rgba(102, 102, 102, 0) 90.01%);
    border-radius: 15px;

}
</style>
<style scoped lang="scss">
@import '/resources/css/mixin.scss';

.image{
    border-radius: 20px;
    overflow: hidden;
    &::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        background: rgba(0, 0, 0, 0.5);
        background: -webkit-gradient(linear, left bottom, left top, from(rgba(0, 0, 0, 0.5)), color-stop(30%, rgba(255, 255, 250, 0)));
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.5) 0%, rgba(255, 255, 250, 0) 50%);
    }
    img {
        filter: brightness(85%);
        aspect-ratio:1;

    }

}
@media only screen and (max-width: 767px) {
    .image {
        margin-bottom: 1rem;
    }
}
.absolute-text{
    z-index: 10;
    bottom: 0;
    left: 0;
    padding: 0 20px;
    padding-bottom: 10px;
    .title{
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        font-size: 20px;
        line-height: 27px;
        text-transform: uppercase;

        color: #FFFFFF;
    }
    .description{
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        font-size: 12px;
        line-height: 15px;

        color: #FFFFFF;
    }
}

.bg-about {

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
p{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 17px;

    color: #FFFFFF;
}
</style>
