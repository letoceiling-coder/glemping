<template>


    <ul class="pagination pagination-sm m-0 float-right" v-if="paginate.meta && paginate.meta.links?.length > 3">
        <li class="page-item" v-for="link in paginate.meta.links" @click="getPage(link.label)"
            v-show="link.url || link.label == '...'">
            <a class="page-link " v-html="link.label" :class="link.active ? 'active' : 'no-active'"
            ></a>
        </li>

    </ul>
</template>

<script>
export default {
    name: "laravel",
    props: {
        paginate: Object,

    },
    data() {
        return {
            page: this.storage.media.filter.page
        }

    },
    methods: {

        getPage(page) {

            if (page === '&laquo; Previous' && this.page !== undefined) {

                this.storage.media.filter.page = (this.page) - 0 - 1
                this.$parent.getImage()
            } else if (page === 'Next &raquo;') {
                this.storage.media.filter.page = (this.page) - 0 + 1
                this.$parent.getImage()
            } else {

                if (this.storage.media.filter.page != page) {
                    this.storage.media.filter.page = page
                    this.$parent.getImage()
                }


            }


        },
    },

}
</script>

<style scoped lang="scss">
.page-item {
    .active {
        background: #007bff;
        color: #ffffff;
    }
}

.no-active {
    cursor: pointer;
}
</style>
