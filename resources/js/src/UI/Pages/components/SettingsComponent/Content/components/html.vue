<template>

    <div class="row card">
        <div class="card-header">
            <label>Вкл\Выкл</label>
            <mc-on-off v-model="setting.on" keys="check"></mc-on-off>
        </div>
        <div class="col-12 card-body" >
            <div class="form-group">
                <label>{{ setting.label }}</label>
                <mc-html v-model="setting.value" keys="html" :options="{code:false}"></mc-html>

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

</style>
