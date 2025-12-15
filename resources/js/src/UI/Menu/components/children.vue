<template>


    <li class="menu-row flex jc-sb parent" :data-id>
        <div class="flex gab-5">
            <div class="flex gab-5 ai-center">
                <button @click="updateForm(menu)"
                        class="btn btn-xs btn-default bg-gradient-white">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
                <button @click="formReset(menu)"
                        class="btn btn-xs btn-default bg-gradient-black">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <button @click="formDelete(menu.id)"
                        class="btn btn-xs btn-default bg-gradient-danger">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </div>

            <div class="flex gab-5 ai-center">
                <span>#{{ menu.id }}</span>

                <span>{{ menu.name }}</span>
                <span>|</span>
                <span>{{ menu.slug }}</span>
                <span>|</span>
                <span :class="menu.active? 'text-green':'text-red'">
                                                        {{ menu.active ? 'активен' : 'не активен' }}
                                                    </span>
                <img v-if="menu.image_id?.webp" :src="menu.image_id.webp" :alt="menu.image_id.name" style="width:100px">
            </div>
        </div>
        <i v-if="menu.items.length > 0" @click="slideTogle($event)"
           class="fa-solid fa-chevron-down mr-4 js-arrow flex-center"></i>
    </li>
    <li class="children">
        <ul v-sortable="{disabled: false, options: { multiDrag: true,group: 'shared',animation: 250, easing: 'cubic-bezier(1, 0, 0, 1)' } }"
            :data-parent="menu.id">
            <Children v-if="menu.items.length > 0" v-for="m in menu.items" :key="m.id" :data-id="m.id" :menu="m"
                      :form="form"></Children>
        </ul>


    </li>


</template>

<script>
export default {
    name: "children",
    props: {
        form: Object,
        menu: Object,
        'data-id': String | null,
        'data-parent': String | null
    },
    mounted() {

        this.sortsMenu()

    },
    methods: {
        updateForm(menu) {

            this.storage.menu.action = 'edit';
            this.form.id = menu.id;
            this.form.name = menu.name;
            this.form.slug = menu.slug;
            this.form.active = menu.active;
            this.form.parent = menu.parent;
            this.form.image_id = menu.image_id;
            this.form._method = 'PUT';
            console.log(menu)
            console.log(this.form)
            $('#modal-slug').modal('show')
        },
        formReset(menu) {
            this.storage.menu.action = 'create';
            this.form.id = null;
            this.form.name = '';
            this.form.slug = '';
            this.form.active = true;
            this.form.parent = menu.id;
            this.form.image_id = {};
            this.form._method = 'POST';
            $('#modal-slug').modal('show')
        },
        formDelete(id ) {
            this.storage.menu.action = 'delete';
            this.form.id = id;
            this.form.name = '';
            this.form.slug = '';
            this.form.active = true;
            this.form.parent = 0;
            this.form.image_id = {};
            this.form._method = 'DELETE';
            $('#modal-delete').modal('show')
        },
        modalForm(menu = null, item = null) {

            this.storage.menu = {
                "id": null,
                "name": "",
                "key": "",
                "slug": "",
                "parent": null,
                "active": true,


            }
            if (this.storage.active === 'create') {
                this.storage.menu.parent = menu.id
                this.storage.menu.slug = `${menu.slug}/`
            } else {
                if (menu) {
                    this.storage.menu = menu
                    this.storage.menu.key = menu.name
                    this.storage.menu.name = menu.name
                }
                if (item) {
                    this.storage.menu = item
                    this.storage.menu.key = item.name
                    this.storage.menu.name = item.name
                }
            }


        },
        slideTogle(e) {
            $(e.target).parent('li').next().slideToggle()

        },


        sortsMenu() {

            this.menu.items = this.menu.items.sort((a, b) => (a.sort > b.sort) ? 1 : -1)

        },

    }
}
</script>

<style scoped lang="scss">
ul, li {
    list-style: none;
}

.menu-row {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px 5px;


}
</style>
