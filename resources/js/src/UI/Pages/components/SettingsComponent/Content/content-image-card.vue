<template>
    <div class="row">
        <div class="col-12" >
            <div class="card">

                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Фото</label>
                                        <mc-btn-image v-model="setting.value.image" keys="image" format="webp.src.id.name"></mc-btn-image>
                                    </div>
                                </div>
                                <div class="col" v-if="setting.value.image.src">
                                    <img :src="setting.value.image.src" :alt="setting.value.image.name" style="max-width: 150px;">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <label>Заголовок</label>
                            <mc-html v-model="setting.value.title" keys="html"></mc-html>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <label>Кнопка</label>
                            <component is="setting-btn" :setting="setting.value.btn"></component>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</template>

<script>
export default {
name: "content-image-card",
    props: {
        setting: Object
    },
}
</script>

<style scoped>

</style>
