<template>


    <template  v-for="container in containers" v-if="load">

        <div :class="this.appendClass(container)">

            <component v-for="component in container.setting.components" :is="'mi-'+component.component"
                       :data="component" ></component>

        </div>

    </template>

</template>

<script>

export default {


    name: "index",
    props: {
        template: {
            type: String,
            default: 'home'
        },
        action: String | null,
        params: String | null,
    },
    data(){
        return{
            containers: [],
            notFound: false,
            personal: false,
            load: false,
        }
    },
    mounted() {
        this.getPage()

    },
    methods: {
        appendClass(data){

            let css = `${data.setting.container} ${data.setting.marginTop} ${data.setting.marginBottom}`
            if (data.setting.class){
                css += ` ${data.setting.class}`
            }
            return css;
        },
        async getPage() {

            await axios.get('/api/v1/pages/get/page', {
                params: {
                    path: window.location.pathname
                }
            }).then(data => {

                if(data.status === 200){
                    console.log(data.data)


                    $('head title').text(data.data.title)
                    $('head meta[name="title"]').attr('content',data.data.title)
                    $('head meta[name="description"]').attr('content',data.data.description)
                    this.containers = data.data.data.sort((a, b) => (a.sort > b.sort) ? 1 : -1)
                    this.containers = this.containers.map(item => {
                        item.setting.components = item.setting.components.sort((a, b) => (a.sort > b.sort) ? 1 : -1)
                        return item
                    })
                    this.load = true
                }else {
                    this.notFound = true
                    this.$router.push('/404')
                }


            })




        },
    }
}
</script>

<style scoped>

</style>
