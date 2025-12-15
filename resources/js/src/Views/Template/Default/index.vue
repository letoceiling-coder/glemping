<template>


    <div :class="this.appendClass(data.view)" :id="`id-${data.id}`" v-html="getField('html').html">


    </div>


</template>

<script>


export default {
    props: {
        data: Object,
    },

    mounted() {



    },
    methods: {

        getField(name) {
            return this.data.fields.find(item => item.space === name)
        },

    },
    data() {
        return {


        }
    }
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';
</style>
