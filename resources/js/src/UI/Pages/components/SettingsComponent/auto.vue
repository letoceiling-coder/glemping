<template>

    <div class="row">
        <div class="col-12" >
            <div class="form-group">
                <label>{{ setting.label }}</label>
                <p>{{setting.text}}</p>
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
