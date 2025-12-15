<template>

    <ul class="pagination pagination-sm m-0 float-right" v-if="paginate && paginate.meta && paginate.meta.links?.length > 3">
        <li class="page-item" v-for="link in paginate.meta.links" @click="getPage(link.label)"
            v-show="link.url || link.label == '...'">
            <a class="page-link " v-html="link.label" :class="link.active ? 'active' : 'no-active'"
            ></a>
        </li>

    </ul>
</template>

<script>
export default {
    name: "default-pagination",
    props: {
        paginate: Object,


    },
    data() {
        return {

        }

    },
    methods: {

        getPage(page) {

            if (page === '&laquo; Previous' && this.$parent.form.page !== undefined) {

                this.$parent.form.page = (this.page) - 0 - 1
                this.$parent.getModel()
            } else if (page === 'Next &raquo;') {
                this.$parent.form.page = (this.$parent.form.page) - 0 + 1
                this.$parent.getModel()
            } else {

                if (this.$parent.form.page != page) {
                    this.$parent.form.page = page
                    this.$parent.getModel()
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
