<template>


    <div :class="this.appendClass(data.view)" :id="`id-${data.id}`">
        <div class="vh-100 w-100">
            <div id="litepmsiframe"><a href="https://litepms.ru/">модуль бронирования для сайта</a></div>
        </div>
    </div>

</template>

<script>

export default {
    props: {
        data: Object,
    },

    mounted() {
        const script = document.createElement('script');
        script.src = 'https://litepms.ru/js/widget_embed.js';
        document.head.appendChild(script);

    },
    methods: {

        getField(name) {
            return this.data.fields.find(item => item.space === name)
        }
    },
    data() {
        return {

        }
    }
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';
.vh-100{
    width: 100vh;
}
@media only screen and (max-width: 767px) {

}

</style>
