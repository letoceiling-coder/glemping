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
                                        <label>Заголовок</label>
                                        <mc-html v-model="setting.value.title" keys="html"></mc-html>
                                    </div>
                                </div>

                            </div>
                            <div class="row" v-for="(description , index) in setting.value.description">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Описание #{{index + 1 }}</label>
                                        <mc-html v-model="description.text" keys="description"></mc-html>
                                    </div>
                                </div>

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
    name: "content-image-card",
    props: {
        setting: Object
    },
}
</script>

<style scoped>

</style>
