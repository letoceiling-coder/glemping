<template>

    <div id="virtual_url" class="w-100 mt-3">
        <h2 class="mc-h2">{{ data.name }}</h2>
        <iframe :src="data.value" class="mt-3"></iframe>


    </div>
</template>

<script>
export default {
    props: {
        data: Object
    },
}
</script>

<style scoped lang="scss">
#virtual_url {
    iframe {
        width: 100%;
        height: 400px;
    }
}
</style>
