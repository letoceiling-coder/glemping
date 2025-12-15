<template>

    <div class="house">
        <div class="product__image_wrapper h-100 image" >
            <img  :src="house.images[0].src" :alt="house.images[0].name " loading="lazy"

                 class="product__image product__first-image w-100" >

        </div>
        <div class="flex jc-sb  pr-2 pl-2 mt-4 z-10 relative ">
            <div class="flex column gab-10">
                <div class="title">{{house.name}}</div>
                <div class="description pr-2 pl-2 mt-4 z-10 relative pb-5">
                    {{house.description}}
                </div>
            </div>
            <div class="flex column gab-10">
            <div class="price flex column gab-10" >
                {{house.price}} р/ночь

            </div>
            <Btn :btn="{route:`booking#mode=embed&page=search&room_id=${house.uid}&search=1`,method:'slug',view:'btn-default'}">Забронировать</Btn>
            </div>
        </div>




    </div>




</template>

<script>

export default {

    name: "index",
    props: {
        house: Object,
    },
    data(){
        return{

        }
    }
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';

.title{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 20.2658px;
    line-height: 27px;
    /* or 133% */

    color: #FFFFFF;

}
.price{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    font-size: 20px;
    line-height: 34px;
    color: #FFFFFF;
}
.description{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 15px;

    color: #FFFFFF;
}
.image {
    overflow:hidden;
    border-radius: 20px;
    img {
        aspect-ratio: 34 / 25;
        transition: transform .5s;
    }
}
.image img:hover {
    transform: scale(1.1);
}


</style>
