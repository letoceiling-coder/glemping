<template>

    <div class="row">
        <div class="col-12" >
            <div class="form-group">
                <label>{{ setting.label }}</label>
                <mc-input type="text" class="form-control" v-model="setting.text"/>
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
