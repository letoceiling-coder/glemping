<template>

    <div class="row">
        <div class="col-12" >
            <div class="card">

                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <label>Заголовок</label>
                            <mc-html v-model="setting.value.title" keys="html"></mc-html>
                        </div>
                    </div>
                    <div class="card" >
                        <div class="card-header">
                            <label>Слайдер мобилный</label>
                            <mc-on-off v-model="setting.value.swiper" keys="check"></mc-on-off>
                        </div>
                        <div class="card-body" v-for="item in setting.value.cards">
                            <div class="form-group" >
                                <label></label>
                                <mc-html v-model="item.text" keys="html"></mc-html>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


        </div>
    </div>
</template>

<script>
export default {
    props: {
        setting: Object
    },
    methods:{

    },
    data(){
        return{

        }
    }
}
</script>

<style scoped>

</style>
