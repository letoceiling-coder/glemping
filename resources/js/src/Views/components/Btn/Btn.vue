<template>
    <button v-if="btn.method == 'method'"
            v-bind="$attrs"
            @click.prevent="this.showModal(btn.route);"
            :class="btn.view" ><slot>ЗАБРОНИРОВАТЬ</slot></button>

    <router-link  v-if="btn.method == 'slug'"
                  :to="btn.route" v-bind="$attrs"
                  :class="btn.view"><slot>ЗАБРОНИРОВАТЬ</slot></router-link>
</template>

<script>
export default {
    name: "Btn",
    props:{
        btn:{
            type:Object,
            default:{
                route:'sign-Up',
                method:'method',
                view:'btn-default'
            }
        }
    },
    methods:{
        showModal(route){

            if ($(`#${route}`).length){
                $(`#${route}`).modal('show')

            }else {
                this.$parent[route]()
            }

        }
    }
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';

button,a{

    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    padding: 0 25px;

    font-family: Montserrat, serif;
    outline: none;

    @include adaptiv-font(14, 12);

    text-decoration: none;


    box-shadow: 0 4px 6px rgb(65 132 144 / 10%), 0 1px 3px rgb(0 0 0 / 8%);
    cursor: pointer;
    user-select: none;
    appearance: none;
    touch-action: manipulation;
    vertical-align: top;
    border-radius: 7px;
    font-style: normal;
    font-weight: 400;
    line-height: 0px;
    height: 45px;
    transition: all 0.2s;


    &:focus-visible {
        transition: all 0.2s;
        outline: none;
    }
    &:hover {
        transition: all 0.2s;
        transform: scale(1.04);
    }

    &:disabled {
        transition: all 0.2s;
        cursor: not-allowed;
    }

}

.btn-default {

    border: 1px solid #00BA57;
    background: #00BA57;
    color: #ffffff;
    &:focus-visible {
        border: 1px solid #00BA57;

    }
    &:hover {

        border: 1px solid #00BA57;
        background-color: #00BA57;
        color: #ffffff;
    }
    &:active {
        background-color: #00BA57;
        color: #00BA57;
    }
    &:disabled {
        background-color: #eee;
        border-color: #eee;
        color: #444;

    }
}
.btn-white {

    border: 1px solid #ffffff;
    background: #ffffff;
    color: #000;
    &:focus-visible {
        border: 1px solid #ffffff;

    }
    &:hover {

        border: 1px solid #ffffff;
        background-color: #ffffff;
        color: #000;
    }
    &:active {
        background-color: #ffffff;
        color: #000;
    }
    &:disabled {
        background-color: #eee;
        border-color: #eee;
        color: #444;

    }
}

@media only screen and (max-width: 767px) {
    button,a{

        padding: 0 10px;
        border-radius: 8px;
    }
}

@media only screen and (max-width: 767px) {
    button,a{
        width: 100%;
        display:flex;
    }
    .m-none{
        display:none!important;
    }
}

</style>
