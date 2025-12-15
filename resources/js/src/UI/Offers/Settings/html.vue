<template>

    <mc-html v-model="data.value" keys="html"></mc-html>
</template>

<script>
export default {

    props:{
        data:Object|null
    },
    created() {
        if (!this.data.value) {
            this.data.value = ''
        }
    },
}
</script>

<style scoped>

</style>
