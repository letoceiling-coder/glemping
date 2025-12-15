<template>
    <div class="row">
        <div class="col-12" >

            <div class="card col-12">
                <div class="card-header">
                    <h5>{{ setting.label }}</h5>
                </div>
                <div class="card-body">
                    <div class="row flex ai-center">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Фото </label>
                                <mc-btn-image v-model="setting.value.image" keys="image" format="webp.src.id.name" ></mc-btn-image>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Текст</label>
                                <mc-textarea type="text" class="form-control" v-model="setting.value.text"/>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-2">
                            <img :src="setting.value.image.src" :alt="setting.value.image.name" class="w-100">
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
