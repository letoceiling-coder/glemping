<template>
    <div class="row">
        <div class="col-12" >

            <div class="card col-12">
                <div class="card-header">
                    <h5>{{ setting.label }}</h5>
                </div>
                <div class="card-body" v-for="image in setting.data">
                    <div class="row flex ai-center">
                        <div class="col-10">
                            <div class="form-group">
                                <label>Фото </label>
                                <mc-btn-image v-model="image.image" keys="image" format="webp.src.id.name" ></mc-btn-image>

                            </div>

                        </div>
                        <div class="col-2">
                            <img :src="image.image.webp" :alt="image.image.name" class="w-100">
                        </div>

                        <div class="col-12" >
                            <div class="form-group">
                                <label>Заголовок (не обязателен)</label>
                                <mc-input type="text" class="form-control" v-model="image.title"/>
                            </div>
                        </div>
                        <div class="col-12" >
                            <div class="form-group">
                                <label>Описание (не обязателен)</label>
                                <mc-textarea type="text" class="form-control" v-model="image.description"/>


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
    mounted() {

    }

}
</script>

<style scoped>

</style>
