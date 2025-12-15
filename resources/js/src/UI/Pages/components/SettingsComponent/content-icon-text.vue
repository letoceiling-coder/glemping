<template>

    <div class="row">
        <div class="col-12" >
            <div class="form-group">
                <label>{{ setting.label }}</label>
                <mc-input type="text" class="form-control" v-model="setting.value.text"/>
                <mc-btn-icon-picker v-model="setting.value.icon" :btn="true"></mc-btn-icon-picker>
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
