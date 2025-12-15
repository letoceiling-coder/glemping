<template>



    <div  :class="this.appendClass(data.view)" :id="`id-${data.id}`" >
        <div id="reviews" class="bg-reviews relative pb-3 pt-5" :style="`background: url(${getField('bg-image').image.webp}) 0% 0% / cover no-repeat;`">

            <div class="container z-10 relative">
                <review-lab data-widgetid="68bbda0c245a461a25dab19b"></review-lab>
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

<style scoped lang="scss">
.bg-reviews{
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
