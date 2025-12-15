<template>
    <div class="fixed left_f" id="fixed">
        <div class="card">
            <div class="card-header flex gab-20">
                <button type="button" class="close m-0" @click="hideFixed('l')" aria-label="Close">
                    <span aria-hidden="true">
                        <
                    </span>
                </button>
                <button type="button" class="close m-0" @click="hideFixed('r')" aria-label="Close">
                    <span aria-hidden="true">
                        >
                    </span>
                </button>
            </div>
            <div class="card-body" id="card-body">
                <div class="form-group">
                    <label>Выбор домика</label>
                    <mc-select :selects="offers" v-model="offer" class="form-control"></mc-select>
                </div>

                <div class="form-group" v-if="offer > 0">
                    <label>Позиция - x</label>
                    <mc-input v-model="offers.find(item => item.id == offer).pos_x" class="form-control"
                              type="number"></mc-input>
                </div>

                <div class="form-group" v-if="offer > 0">
                    <label>Позиция - y</label>
                    <mc-input v-model="offers.find(item => item.id == offer).pos_y" class="form-control"
                              type="number"></mc-input>
                </div>

                <div class="form-group" v-if="offer > 0">
                    <label>Ширина</label>
                    <mc-input v-model="offers.find(item => item.id == offer).width" class="form-control"
                              type="number"></mc-input>
                </div>
                <div class="form-group" v-if="offer > 0">
                    <label>Высота</label>
                    <mc-input v-model="offers.find(item => item.id == offer).height" class="form-control"
                              type="number"></mc-input>
                </div>

                <div class="form-group" v-if="offer > 0">
                    <label>Фото</label>
                    <div class="images relative">
                        <img @click="imageShow" :src="images.find(item => item.id == offers.find(item => item.id == offer).image_id).path" >
                        <div class="img-group absolute">
                            <div class=" flex column gab-10  ">
                                <template v-for="image in images">

                                    <img @click="offers.find(item => item.id == offer).image_id = image.id" :src="image.path" alt="" >
                                </template>

                            </div>
                        </div>


                    </div>

                </div>
                <div class="form-group" v-if="offer > 0">
                    <button @click="saveImage" type="button" class="btn btn-sm mr-3 btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {notify} from "@kyvg/vue3-notification";

export default {
    name: "settingsMap",
    props: {
        offers: Object,
        images: Object,
    },
    data() {
        return {
            offer: 0,

        }
    },
    methods: {
        hideFixed(p){
            console.log(p)
            if (p == 'l'){
                $('#fixed').addClass('left_f').removeClass('right_f')
            }
            if (p == 'r'){
                $('#fixed').addClass('right_f').removeClass('left_f')
            }

        },
        imageShow(){
            $('.img-group').slideToggle()
        },
        async saveImage() {

            let offer = this.offers.find(item => item.id == this.offer)
            offer._method = 'PUT'
            await axios.post(`/api/v1/offers/${this.offer}`, offer).then(data => {
                if (data) {
                    notify({
                        title: "Уведомление",
                        text: "Изменено",
                        type: "success",
                    });
                }


            }).catch((error) => {
                console.log(error)

            })

        },

    }
}
</script>

<style scoped lang="scss">
.card{
    height: 400px;
    overflow:scroll;
}
.img-group{
    left: 10px;
    top: 0;
    background: #fff;
    overflow:scroll;
    height: 180px;

    padding: 3px 3px 50px 3px;

    display: none;
    img{
        margin: 3px;
        cursor:pointer;
    }

    img:hover{
        border:1px solid red;

    }
}
.images{
    img {
        width: 150px;
    }

}
.fixed {
    position: fixed;


    top: 100px;
}
.left_f{
    left: 0;
}
.right_f{
    right:  0;
}
</style>
