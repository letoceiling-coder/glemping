<template>

    <div class="row">
        <div class="col-12" >
            <div class="form-group">
                <label>{{ setting.label }}</label>
                <mc-on-off v-model="setting.value"/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "on-off",
    props: {
        setting: Object
    }
}
</script>

<style scoped>

</style>
