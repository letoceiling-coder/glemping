<template>

    <div class="app" >
        <router-view :key="this.$route.fullPath" ref="page"/>

    </div>
    <notifications/>
    <FactoryModal/>
    <Thank/>

</template>

<script>
import Thank from '/resources/js/src/UI/Modal/modal-Thank.vue'
export default {
name: "Lte",
components:{
    Thank
}

}
</script>

<style lang="scss">
@media only screen and (max-width: 768px) {
    .mb-5,.mb-4 {
        margin-bottom: 1rem !important;
    }
    .mt-5,.mt-4 {
        margin-top: 1rem !important;
    }
}
</style>
