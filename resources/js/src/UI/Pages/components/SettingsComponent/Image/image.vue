<template>
    <div class="row">
        <div class="col-12" >

            <div class="card col-12">
                <div class="card-header">
                    <h5>{{ setting.label }}</h5>
                </div>
                <div class="card-body" v-if="setting.image">
                    <div class="row flex ai-center">
                        <div class="col-2">
                            <div class="form-group">
                                <label>Фото </label>
                                <mc-btn-image v-model="setting.image" keys="image" format="webp.src.id.name" ></mc-btn-image>

                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label>Фото - описание</label>
                                <mc-input type="text" class="form-control" v-model="setting.image.name"/>
                            </div>
                        </div>
                        <div class="col-2">
                            <img :src="setting.image.src" :alt="setting.image.name" class="w-100">
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
        console.log(this.setting.image)
        if (!this.setting.image){
            this.setting.image = {}
        }
        this.setting.value = this.setting.image
        console.log(this.setting)
    }

}
</script>

<style scoped>

</style>
