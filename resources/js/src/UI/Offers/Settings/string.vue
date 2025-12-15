<template>
    <mc-input v-model="data.value" class="form-control"></mc-input>
</template>

<script>
export default {
name: "string",
    props:{
        data:Object|null
    },
    created() {

        if (!this.data.value){
            this.data.value = ''
        }
    },
}
</script>

<style scoped>

</style>
