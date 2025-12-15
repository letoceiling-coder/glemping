<template>
    <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"

         aria-hidden="true" id="modal-Thank">

        <div class="modal-dialog modal-md">
            <div class="modal-content relative">


                <div class="modal-body" id="modal-Thank-bg">
                    <h2>Готово!</h2>
                    <p class="mt-3 text-center">Скоро вы отправитесь в образовательное
                        путешествие</p>
                    <p class="mt-3 text-center">Наш специалист свяжется с вами в течение часа <br
                    > для уточнения вопросов</p>
                    <div class="flex-center">
                        <img :src="'/img/Successful_illus.png'" alt="" style="max-width: 100px;"></div>
                    <div class="flex-center pb-5">
                        <Btn @click="this.modalClose($event)" class="mt-3"
                             :btn="{method:'method',text:'Отлично',view:'btn-default'}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Btn from '/resources/js/src/Views/components/Btn/Btn-default.vue'
export default {
name: "modal-Thank",
    components:{
        Btn
    },
    methods:{
        modal(option) {
            $('.modal').modal(option)
        },
    }
}
</script>

<style scoped>
#modal-Thank-bg {
    background: url(/img/modal-bg.png) no-repeat center center;
    background-size: cover;
}
</style>
