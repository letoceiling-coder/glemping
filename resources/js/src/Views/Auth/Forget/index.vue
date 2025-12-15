<template>
    <div :class="this.appendClass(data.view)" :id="`id-${data.id}`" v-if="load">

        <Forget></Forget>

    </div>

</template>

<script>

import VRC from "/resources/js/src/Views/components";
import Forget from "/resources/js/src/Pages/Auth/forget.vue";

export default {
    components: {Forget},
    name: "index",
    props: {
        data: Object,
    },
    data() {
        return {
            load: true,
            VRC: new VRC(),
            resources: {},

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

</style>
