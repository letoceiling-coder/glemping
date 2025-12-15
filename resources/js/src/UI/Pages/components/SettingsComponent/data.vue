<template>

    <div class="row">
        <div class="col-12" >
            <div class="form-group">
                <label>{{ setting.label }}</label>
                <div class="card" v-for="value in setting.value">

                    <div class="card-body" v-for="val in value">
                        <pre>{{val}}</pre>
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

</style>
