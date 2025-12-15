<template>
    <div class="row">
        <div class="col-12" >
            <div class="form-group" v-for="row in setting.rows">
                <div class="row">
                    <div class="col-6">
                        <mc-input  class="form-control" v-model="row.name" keys="name"></mc-input>
                    </div>
                    <div class="col-6">
                        <mc-input class="form-control" v-model="row.value" keys="value"></mc-input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "price",
    props: {
        setting: Object
    }
}
</script>

<style scoped>

</style>
