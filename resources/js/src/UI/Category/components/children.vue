<template>


    <li class="category-row flex jc-sb parent" :data-id>
        <div class="flex gab-5">
            <div class="flex gab-5 ai-center">
                <button @click="updateForm(category)"
                        class="btn btn-xs btn-default bg-gradient-white">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
<!--                <button @click="formReset(category)"-->
<!--                        class="btn btn-xs btn-default bg-gradient-black"-->
<!--                        data-toggle="modal" data-target="#modal-slug">-->
<!--                    <i class="fa-solid fa-plus"></i>-->
<!--                </button>-->
                <button @click="formDelete(category.id)"
                        class="btn btn-xs btn-default bg-gradient-danger">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </div>

            <div class="flex gab-5 ai-center">
                <span>#{{ category.id }}</span>

                <span>{{ category.name }}</span>
                <span>|</span>
                <span>{{ category.slug }}</span>
                <span>|</span>
                <span :class="category.active? 'text-green':'text-red'">
                                                        {{ category.active ? 'активен' : 'не активен' }}
                                                    </span>
                <img v-if="category.image_id?.webp" :src="category.image_id.webp" :alt="category.image_id.name" style="width:100px">
            </div>
        </div>

    </li>



</template>

<script>
export default {
    name: "children",
    props: {
        form: Object,
        category: Object,
        'data-id': String | null,
        'data-parent': String | null
    },
    mounted() {

        this.sortsCategory()

    },
    methods: {
        updateForm(category) {

            this.storage.category.action = 'edit';
            this.form.id = category.id;
            this.form.name = category.name;
            this.form.slug = category.slug;
            this.form.active = category.active;
            this.form.parent = category.parent;
            this.form._method = 'PUT';
            $('#modal-slug-category').modal('show')
        },
        formReset(category) {
            this.storage.category.action = 'create';
            this.form.id = null;
            this.form.name = '';
            this.form.slug = '';
            this.form.active = true;
            this.form.parent = category.id;
            this.form._method = 'POST';
            $('#modal-slug-category').modal('show')
        },
        formDelete(id ) {
            this.storage.category.action = 'delete';
            this.form.id = id;
            this.form.name = '';
            this.form.slug = '';
            this.form.active = true;
            this.form.parent = 0;
            this.form._method = 'DELETE';
            $('#modal-delete-category').modal('show')
        },
        modalForm(category = null, item = null) {

            this.storage.category = {
                "id": null,
                "name": "",
                "key": "",
                "slug": "",
                "parent": null,
                "active": true,


            }
            if (this.storage.active === 'create') {
                this.storage.category.parent = category.id
                this.storage.category.slug = `${category.slug}/`
            } else {
                if (category) {
                    this.storage.category = category
                    this.storage.category.key = category.name
                    this.storage.category.name = category.name
                }
                if (item) {
                    this.storage.category = item
                    this.storage.category.key = item.name
                    this.storage.category.name = item.name
                }
            }


        },
        slideTogle(e) {
            $(e.target).parent('li').next().slideToggle()

        },


        sortsCategory() {

            // this.category.items = this.category.items.sort((a, b) => (a.sort > b.sort) ? 1 : -1)

        },

    }
}
</script>

<style scoped lang="scss">
ul, li {
    list-style: none;
}

.category-row {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px 5px;


}
</style>
