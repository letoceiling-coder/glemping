<template>

    <div class="card-html">
        <div class=" card-header " :id="data.id">
            <h3 class="card-title">{{ data.name }}</h3>
            <div class="card-tools">
                <i class="fas cursor" :class="data.open ? 'fa-plus' : 'fa-minus'" @click="toggleBody($event)"></i>
            </div>
        </div>
        <div class="card-body">
            <div class="p-3" v-html="data.value"></div>
        </div>
    </div>

</template>

<script>


export default {
    props: {
        data: Object
    },
    methods:{
        toggleBody(e){
            this.data.open = !this.data.open
            $(e.target).closest('.card-html').find('.card-body').slideToggle()
        }
    },
    components: {

    },
    name: "card-html"
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';
.card-html {
    .card-header{
        background: #fff;
    }
    padding: 20px;
    ul,li {
        list-style: disc!important;
    }
    h4{
        @include adaptiv-font(26, 22);
    }
    ul li{
        margin-bottom: 20px;

        font-family: 'TT Interfaces',serif;
        font-style: normal;
        font-weight: 400;
        @include adaptiv-font(16, 14);
        line-height: 22px;

        color: #1C1C1C;


    }
}
@media only screen and (max-width: 768px) {
    .card-html {
        padding: 0;
    }
}
</style>
