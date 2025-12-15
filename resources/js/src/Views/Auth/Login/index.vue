<template>
    <div :class="this.appendClass(data.view)" :id="`id-${data.id}`" v-if="load">

        <Login></Login>

    </div>

</template>

<script>

import VRC from "/resources/js/src/Views/components";
import Login from "/resources/js/src/Pages/Auth/login.vue";

export default {
    components: {Login},
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
