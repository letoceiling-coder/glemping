<template>

    <div class="app" >
        <router-view :key="this.$route.fullPath" ref="page"/>

    </div>
    <notifications/>
</template>

<script>
export default {
name: "Lte",

}
</script>

<style scoped>

</style>
