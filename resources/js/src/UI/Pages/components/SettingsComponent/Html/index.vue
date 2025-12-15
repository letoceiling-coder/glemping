<template>

    <div class="row card">
        <div class="col-12 card-body" >
            <div class="form-group">
                <label>{{ setting.label }}</label>
                <mc-html v-model="setting.html" keys="html" :options="{code:false}"></mc-html>

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
