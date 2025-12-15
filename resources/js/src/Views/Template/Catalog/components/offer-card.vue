<template>

    <div class="offer-card relative" v-if="offer">

        <swiper :slidesPerView="1"
                :space-between="10"
                :autoplay="{
                                      delay: 5000,
                                      disableOnInteraction: true,
                                    }"
                :pagination="{clickable: true}"
                :modules="modules"
                :navigation="{nextEl:'.arrow-next',prevEl:'.arrow-prev'}"

                class="my-swiper relative "

        >
            <swiper-slide class="relative " >
                <div class="as-ratio"
                     :style="`background: url(${offer.images[0].original ?? offer.images[0].webp}) 50% 50% / cover no-repeat;`"></div>

            </swiper-slide>


        </swiper>
        <div class="container">
            <div class="breadcrumbs  absolute">
                <Breadcrumbs :offer="offer"/>
                <div class="label flex-wrap mt-4" >
                    <span v-for="property in offer.properties_info" class="mb-3 mr-3">{{property.name}}</span>
                </div>

            </div>
        </div>
        <div class="info-bottom">
          <div class="row h-100 w-100 pb-3 m-auto">
              <div class="col-md-6 col-12 col-sm-12 flex column ai-center jc-center  ">
                  <h2 class="h2 flex gab-20 ai-center" >{{offer.name}}

                      <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <foreignObject x="-4" y="-4" width="53" height="53"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(2px);clip-path:url(#bgblur_0_230_1420_clip_path);height:100%;width:100%"></div></foreignObject><g data-figma-bg-blur-radius="4">
                          <rect width="45" height="45" rx="22.5" fill="#00BA57"/>
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M26.3062 11.25C25.7659 11.2498 25.2321 11.37 24.7425 11.6021C24.2529 11.8343 23.8194 12.1726 23.4727 12.5934C23.1259 13.0142 22.8743 13.5071 22.7356 14.0373C22.5969 14.5676 22.5744 15.1223 22.6699 15.6623L17.2949 19.4839C17.268 19.5028 17.2422 19.5232 17.2176 19.5451C16.6724 19.1122 16.0182 18.8437 15.3299 18.7701C14.6416 18.6965 13.9467 18.8208 13.3246 19.1288C12.7025 19.4368 12.1781 19.9161 11.8113 20.5121C11.4445 21.1081 11.25 21.7967 11.25 22.4995C11.25 23.2023 11.4445 23.891 11.8113 24.4869C12.1781 25.0829 12.7025 25.5622 13.3246 25.8702C13.9467 26.1782 14.6416 26.3025 15.3299 26.2289C16.0182 26.1553 16.6724 25.8868 17.2176 25.454C17.2422 25.4762 17.268 25.497 17.2949 25.5163L22.6699 29.3378C22.5103 30.241 22.6824 31.1723 23.1536 31.9553C23.6248 32.7383 24.3623 33.3187 25.2266 33.5866C26.0909 33.8545 27.022 33.7914 27.8435 33.4091C28.665 33.0268 29.32 32.352 29.6845 31.5123C30.0489 30.6726 30.0975 29.7264 29.8211 28.8528C29.5446 27.9792 28.9623 27.2388 28.1844 26.7719C27.4065 26.3049 26.487 26.1437 25.5999 26.3189C24.7129 26.4941 23.9198 26.9934 23.371 27.7224L18.2813 24.1051C18.5085 23.6182 18.6358 23.0747 18.6358 22.5001C18.6358 21.9255 18.5085 21.3808 18.2813 20.8951L23.3721 17.2766C23.7535 17.7834 24.2558 18.1831 24.8317 18.4379C25.4076 18.6927 26.0379 18.7941 26.6632 18.7326C27.2884 18.671 27.8878 18.4486 28.4048 18.0862C28.9218 17.7239 29.3392 17.2337 29.6175 16.6619C29.8959 16.0901 30.0261 15.4557 29.9957 14.8186C29.9653 14.1815 29.7754 13.5628 29.4439 13.021C29.1124 12.4792 28.6502 12.0323 28.1012 11.7224C27.5522 11.4125 26.9343 11.2499 26.3062 11.25ZM24.3176 15C24.3176 14.4645 24.5271 13.9509 24.9 13.5722C25.273 13.1935 25.7788 12.9808 26.3062 12.9808C26.8336 12.9808 27.3394 13.1935 27.7124 13.5722C28.0853 13.9509 28.2948 14.4645 28.2948 15C28.2948 15.5356 28.0853 16.0492 27.7124 16.4278C27.3394 16.8065 26.8336 17.0193 26.3062 17.0193C25.7788 17.0193 25.273 16.8065 24.9 16.4278C24.5271 16.0492 24.3176 15.5356 24.3176 15ZM14.9427 20.4808C14.4153 20.4808 13.9094 20.6936 13.5365 21.0723C13.1636 21.4509 12.9541 21.9645 12.9541 22.5001C12.9541 23.0356 13.1636 23.5492 13.5365 23.9279C13.9094 24.3066 14.4153 24.5193 14.9427 24.5193C15.4701 24.5193 15.9759 24.3066 16.3488 23.9279C16.7218 23.5492 16.9313 23.0356 16.9313 22.5001C16.9313 21.9645 16.7218 21.4509 16.3488 21.0723C15.9759 20.6936 15.4701 20.4808 14.9427 20.4808ZM26.3062 27.9809C25.7788 27.9809 25.273 28.1936 24.9 28.5723C24.5271 28.951 24.3176 29.4646 24.3176 30.0001C24.3176 30.5357 24.5271 31.0493 24.9 31.428C25.273 31.8066 25.7788 32.0194 26.3062 32.0194C26.8336 32.0194 27.3394 31.8066 27.7124 31.428C28.0853 31.0493 28.2948 30.5357 28.2948 30.0001C28.2948 29.4646 28.0853 28.951 27.7124 28.5723C27.3394 28.1936 26.8336 27.9809 26.3062 27.9809Z" fill="white"/>
                      </g>
                          <defs>
                              <clipPath id="bgblur_0_230_1420_clip_path" transform="translate(4 4)"><rect width="45" height="45" rx="22.5"/>
                              </clipPath></defs>
                      </svg>
                  </h2>
                  <p>Мест в домике: {{offer.places}} Дополнительных мест: {{offer.dop}} Площадь: {{offer.square}} м2</p>
              </div>
              <div class="col-md-6 col-12 col-sm-12">
                    <div class="row h-100 jc-center ai-center">
                        <div class="col-6 flex column jc-center ai-center">
                            <p>Стоимость за сутки</p>
                            <div class="price">
                                От {{offer.price}} руб
                            </div>
                        </div>
                        <div class="col-6 flex column jc-center ai-center">
                            <p>Заселение / выселение</p>
                            <div class="price">
                                13:30 / 10:30
                            </div>
                        </div>
                    </div>
              </div>
          </div>
        </div>

    </div>


</template>

<script>
import Breadcrumbs from '/resources/js/src/Views/Breadcrumbs/index.vue'
import {Swiper, SwiperSlide} from 'swiper/vue';

import {Autoplay, Scrollbar, Navigation, Pagination} from 'swiper/modules';

export default {
    components:{
        Swiper, SwiperSlide,Breadcrumbs
    },
    name: "offer-card",
    props: {
        offer: Object,
    },
    data() {
        return {


            modules: [Autoplay],
        }
    },
    mounted() {



    },
    watch:{
        offer(){
            lpmsrid = this.offer.uid ?? 60082

        }
    }
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';
.as-ratio{
    aspect-ratio:120/49;
}
@media only screen and (max-width: 767px) {
    .as-ratio{
        aspect-ratio:32/49;
    }
}
.price{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 700;
    font-size: 18px;
    line-height: 22px;
    /* identical to box height */
    display: flex;
    align-items: center;
    text-transform: lowercase;

    color: #FFFFFF;
}
.h2{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    @include adaptiv-font(36, 15);
    line-height: 50px;

    color: #FFFFFF;
}
p{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    @include adaptiv-font(14, 12);
    line-height: 17px;

    color: #FFFFFF;
}
.info-bottom{
    /* Rectangle 24 */

    position: absolute;
    width: 100%;
    height: 140px;
    left: 0;
    bottom: 0;
    z-index: 5;
    background: rgba(34, 34, 34, 0.6);
    backdrop-filter: blur(5px);

    border-radius: 55px 55px 0px 0px;

}

@media only screen and (max-width: 767px) {
    .info-bottom{
        border-radius: 0;
        height: auto;

    }
}
.bg-gray {

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
.my-swiper{
    //max-height: 490px;
    aspect-ratio:120/49;

}
@media only screen and (max-width: 767px) {
    .my-swiper{
        //max-height: 100%;
        aspect-ratio:32/49;
    }
}
.breadcrumbs{
    top: 20px;
    z-index: 5;
}
.label {

    span{
        background: #00BA57;
        backdrop-filter: blur(2px);

        border-radius: 20px;
        padding: 12px 30px;
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 600;
        @include adaptiv-font(12, 12);

        line-height: 15px;

        color: #FFFFFF;
    }
}
</style>
