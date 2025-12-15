<template>
    <svg @click.prevent="favourites(card)" width="26" height="24" viewBox="0 0 26 24" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="M22.9741 2.75288C20.173 -0.10363 16.9294 1.10111 14.921 2.37513C13.7862 3.09501 12.2141 3.09501 11.0793 2.37513C9.07087 1.10112 5.82732 -0.103598 3.02626 2.75288C-3.62304 9.53375 7.77994 22.6003 13.0002 22.6003C18.2204 22.6003 29.6233 9.53374 22.9741 2.75288Z"
            stroke="url(#paint0_linear_1600_3012)" stroke-width="1.5" stroke-linecap="round"
            :fill="card.favourites ? 'rgb(242, 92, 146)': ''"
            stroke-linejoin="round"/>
        <defs>
            <linearGradient id="paint0_linear_1600_3012" x1="1" y1="1" x2="25.6383"
                            y2="1.75398"
                            gradientUnits="userSpaceOnUse">
                <stop stop-color="#F25F5C"/>
                <stop offset="1" stop-color="#F25C92"/>
            </linearGradient>
        </defs>
    </svg>
</template>

<script>
export default {
    name: "favourites",
    props:{
        card:Object
    },
    mounted() {
        this.isFavourites(this.card)
    },
    methods:{
        favourites(card){
            // if (!this.storage.settings.mode){
            //     ym(100258487, 'reachGoal', 'favorites');
            // }

            card.favourites = !card.favourites
            if (card.favourites) {
                this.storage.favourites.push({id:card.id})
            } else {

                this.storage.favourites.find((item, index) => {

                    if (item?.id === card.id) {
                        this.storage.favourites.splice(index, 1)
                    }
                })
            }

            localStorage.setItem('favourites', JSON.stringify(this.storage.favourites));


        },
        isFavourites(data) {
            let local = localStorage.getItem('favourites')
            if (local) {
                local = this.storage.favourites = JSON.parse(local)

                if (local.find(val => val.id === data.id)) {

                    data.favourites = true
                }

            }

        },
    }
}
</script>

<style scoped>

</style>
