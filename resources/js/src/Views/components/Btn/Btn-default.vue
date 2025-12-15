<template>

    <button @click="handleClick" v-if="btn.method == 'method'"
            :class="btn.view">{{btn.text}}</button>


</template>

<script>
export default {
    name: "Btn",
    props:{
        btn:Object,
        offer:Number|null,
    },
    methods: {

        handleClick() {
            // this.$emit('click');
            console.log(123)
        },

    }
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';
.block{
    flex:1;
}
button,a{
    margin-bottom: 5px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    padding: 0 25px;
    font-family: "TT Interfaces", serif;
    outline: none;

    @include adaptiv-font(16, 14);

    text-decoration: none;


    box-shadow: 0 4px 6px rgb(65 132 144 / 10%), 0 1px 3px rgb(0 0 0 / 8%);
    cursor: pointer;
    user-select: none;
    appearance: none;
    touch-action: manipulation;
    vertical-align: top;
    border-radius: 12px;
    font-style: normal;
    font-weight: 500;
    line-height: 0px;
    height: 48px;
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

    border: 1px solid #387BFF;
    background: #387BFF;
    color: #E6EEFF;
    &:focus-visible {
        border: 1px solid #387BFF;

    }
    &:hover {

        border: 1px solid #E6EEFF;
        background-color: #E6EEFF;
        color: #387BFF;
    }
    &:active {
        background-color: #E6EEFF;
        color: #387BFF;
    }
    &:disabled {
        background-color: #eee;
        border-color: #eee;
        color: #444;

    }
}
a{
    color: #ffffff;
    background: #387BFF;
    &:hover {
        color: #000000;
        background: #fcca19;


    }
}





.btn-my-light{
    border: 1px solid #E6EEFF;
    background: #E6EEFF;
    color: #387BFF;
    &:focus-visible {
        border: 1px solid #E6EEFF;

    }
    &:hover {

        border: 1px solid #387BFF;
        background-color: #387BFF;
        color: #E6EEFF;
    }
    &:active {
        background-color: #387BFF;
        color: #E6EEFF;
    }
    &:disabled {
        background-color: #eee;
        border-color: #eee;
        color: #444;

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
