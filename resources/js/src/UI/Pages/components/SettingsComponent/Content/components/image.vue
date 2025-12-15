<template>
    <div class="row">
        <div class="col-12" >

            <div class="card col-12">
                <div class="card-header">
                    <h5>{{ setting.label }}</h5>
                </div>
                <div class="card-body">
                    <div class="row flex ai-center gab-20">
                        <div class="form-group">
                            <label>Фото </label>
                            <mc-btn-image v-model="setting.value" keys="image" format="webp.src.id.name" ></mc-btn-image>

                        </div>

                        <div class="images">
                            <img :src="setting.value.src" :alt="setting.value.name" class="w-100">
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
    }
}
</script>

<style scoped>
.images{
    max-width: 150px;
}
</style>
