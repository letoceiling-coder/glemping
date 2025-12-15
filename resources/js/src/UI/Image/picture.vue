<template>
    <picture v-if="image">
        <source :srcset="image.webp" type="image/webp">
        <img :src="image.src"  v-bind="$attrs"
             :alt="image.name" class="w-100">
    </picture>
</template>

<script>
export default {
    props:{
        image:Object|null,
    }
}
</script>

<style scoped>

</style>
