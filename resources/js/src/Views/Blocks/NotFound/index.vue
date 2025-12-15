<template>


    <div :class="this.appendClass(data.view)" :id="`id-${data.id}`">
        <div class=" bg-not-found relative  flex-center" :style="`background: url(${getField('bg-image')?.image?.webp ?? ''}) 50% / cover no-repeat;`">
<!--            <img class="bg-not-found" :src="getField('bg-image').image.webp" alt="">-->
            <div class="absolute flex column ai-center jc-center">
                <div class="title">
                    {{getField('title').text}}
                </div>
                <div class="description">
                    {{getField('description').text}}
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
        },

    },
    mounted() {

    },

}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';
.bg-not-found{
    height: 100vh;
    width: 100%;
    position: relative;
    margin-top: -70px;


}
.title{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 800;
    @include adaptiv-font(160, 80);
    line-height: 200px;
    color: #FFFFFF;

}
@media only screen and (max-width: 767px) {
    .title{
        line-height: 100px;
    }
    .description{
        line-height: 24px;
    }
    .bg-not-found{

        margin-top: -60px;


    }
}
.description{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    @include adaptiv-font(36, 20);
    line-height: 44px;
    color: #FFFFFF;
}
</style>
