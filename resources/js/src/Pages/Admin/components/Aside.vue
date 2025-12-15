<template>
    <aside class="control-sidebar control-sidebar-dark " >
    <component :is="`aside-${this.storage.aside}`"></component>
    </aside>
</template>

<script>
import AsideDefault from '/resources/js/src/Pages/Admin/components/Aside-default.vue'
import AsideForm from '/resources/js/src/Pages/Admin/components/Aside-form.vue'
export default {
    components:{
        'aside-default' : AsideDefault,
        'aside-form' : AsideForm,
    }
}
</script>

<style scoped lang="scss">
.control-sidebar{
    z-index: 999999;

}
</style>
