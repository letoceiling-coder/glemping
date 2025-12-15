<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <router-link  :to="'/admin/personal'" class="brand-link">
            <img :src="this.storage.settings.info.logo" alt="AdminPanel"
                 class="brand-image img-circle " style="opacity: .8">
            <span class="brand-text font-weight-light">{{ this.storage.settings.info.company }}</span>
        </router-link>


        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="this.storage.settings.user.image ?? this.storage.settings.default.img" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <router-link  :to="'/admin/personal'" class="d-block">{{this.storage.settings.user.name}} </router-link>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar MenuController -->
            <SidebarMenu />

            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
import SidebarMenu from "/resources/js/src/Pages/Admin/components/SidebarMenu.vue";
export default {
name: "SideBar",
    components:{
        SidebarMenu
    },

}
</script>

<style scoped lang="scss">
.image{
    max-width: 100px;
    img{
        aspect-ratio:1;
    }
}
</style>
