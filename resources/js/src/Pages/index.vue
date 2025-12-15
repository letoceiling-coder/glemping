<template>
    {{$props}}
    <component :is="this.template" ></component>
</template>

<script>
export default {
name: "index",
    mounted() {
        this.getPage()
    },
    methods: {

        async getPage() {
            if (this.template == '404'){
                this.notFound = true
            }else {
                await axios.get('/api/v1/pages/get/page', {
                    params: {
                        path: window.location.pathname
                    }
                }).then(data => {
                    console.log(data)
                    // if(data){
                    //     this.containers = data.data.container.sort((a, b) => (a.sort > b.sort) ? 1 : -1)
                    //     this.containers = this.containers.map(item => {
                    //         item.components = item.components.sort((a, b) => (a.sort > b.sort) ? 1 : -1)
                    //         return item
                    //     })
                    // }else {
                    //     this.notFound = true
                    //     this.$router.push('/404')
                    // }

                    console.log(this.containers)
                })
            }


        },
    }
}
</script>

<style scoped>

</style>
