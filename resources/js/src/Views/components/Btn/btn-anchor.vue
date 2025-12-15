<template>
    <a class="btn-anchor" :href="`#${slug}`" @click.prevent="scrollFix($event)">{{text}}</a>
</template>

<script>
export default {
    name: "btn-anchor",
    props:{
        slug:{type:String,default:'#'},
        text:{type:String,default:''},
    },
    mounted() {

    },
    methods:{
        scrollFix(e)
        {
            if (e){
                let elementClick;
                elementClick = $(e.target).attr('href');
                let destination;
                destination = $(elementClick).offset().top;
                $('body,html').animate({scrollTop: destination - 180 }, 1400);
            }
        }
    }
}
</script>

<style scoped lang="scss">

.btn-anchor{
    margin-right: 1rem;
    display: inline-flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    padding: 10px 20px;
    border: 1px solid #FFFFFF;
    background: #FFFFFF;
    border-radius: 45px;
    transform: matrix(1, 0, 0, 1, 0, 0);
    transition: all 0.2s;
    color: #000000;
    &:hover{
        border: 1px solid #387BFF;
        background: #387BFF;
        color: #E6EEFF;
    }

}
</style>
