<template>
    <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" v-if="menus.length > 0" >



            <li class="nav-item menu_item" v-for="menu in menus" >

                <template v-if="menu.slug">
                    <router-link :to="`/admin/${menu.slug}`" class="nav-link " >
                        <i class="nav-icon" :class="menu.icon"></i>
                        <p>
                            {{ menu.name }}
                            <i class="right fas fa-angle-left" v-if="menu.items.length > 0"></i>
                        </p>
                    </router-link>
                </template>
                <template v-if="!menu.slug">
                    <span class="nav-link " v-if="menu.role <= this.storage.settings.user.role.id" @click="slideDown($event)">
                        <i class="nav-icon" :class="menu.icon"></i>
                        <p>
                            {{ menu.name }}
                            <i class="right fas fa-angle-left" v-if="menu.items.length > 0"></i>
                        </p>
                    </span>
                </template>

                <ul class="nav nav-treeview" v-if="menu.items.length > 0">
                    <li class="nav-item" v-for="item in menu.items" >
                        <router-link :to="`/admin/${item.slug}`" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ item.name }}</p>
                        </router-link>
                    </li>

                </ul>
            </li>


        </ul>
    </nav>
</template>

<script>
export default {
name: "SidebarMenu",
    data(){
    return{
        menus:[]
    }
    },
    mounted() {
        this.getMenu()
    },
    methods:{
        slideDown(event){
            console.log(event.target)
            $(event.target).closest('li').toggleClass('menu-is-opening menu-open')
        },
        async getMenu() {

            await axios.post('/api/v1/admin/menus').then(data => {
                console.log(data.data)
                this.menus = data.data
                setTimeout(function(){
                    $('.router-link-active').closest('.menu_item').find('span').trigger('click')
                }, 1000);
            }).catch((error) => {
                console.log(error)

            })

        }
    }
}
</script>

<style scoped lang="scss">
.nav-item {
    span {
        color: #c2c7d0;
    }
}

.router-link-active {
    background-color: rgba(255, 255, 255, .9) !important;
    color: #343a40 !important;
}

.nav-item:has(ul li .router-link-active) span {
    background-color: #007bff!important;
    color: #fff!important;
}
</style>
