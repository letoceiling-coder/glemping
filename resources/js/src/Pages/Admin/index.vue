<template>
    <div ref="apps" v-if="load">
        <div id="grayout" style="display: none;"></div>
        <NavBar/>
        <SideBar/>
        <div class="content-wrapper">
            {{$props}}
            <component :is="load"></component>
        </div>

        <Footer/>
        <Aside/>
    </div>
    <notifications/>
    <ImageModal/>
</template>

<script>
import registerComponents from './components.js'
import Aside from "./components/Aside.vue";
import Footer from './components/Footer.vue'
import NavBar from './components/NavBar.vue'
import SideBar from './components/SideBar.vue'
import Defined from '/resources/js/src/Pages/NotFound/index.vue'
import ImageModal from '/resources/js/src/UI/Media/components/modal/modal-images.vue'




export default {
    components: Object.assign({
        Aside, Footer, NavBar, SideBar,ImageModal,
        defined: Defined,

    }, registerComponents),
    name: "index",

    props: {
        template: {
            type: String,
            default: 'home'
        },
        action: String | null,
        params: String | null,
        id: String | null,
    },
    data() {
        return {
            load: null,
        }
    },
    mounted() {
        if (this.Helper.getUserRole() == 1) {
            window.location.href = "/login"
        }
        if (this.template == '') {
            this.$router.push('/admin/dashboard')
        }
        this.checkAccess()
    },
    methods: {
        async checkAccess() {

            await axios.post(`/api/v1/admin/menu/${this.template}`).then(data => {

                if (this.Helper.isAccess(data.data.role)) {
                    this.load = this.template
                } else {
                    this.load = 'defined'
                }

            }).catch((error) => {
                console.log(error)

            })

        }
    }
}
</script>

<style scoped>

</style>
