<template>
    <aside class="control-sidebar control-sidebar-dark " >

        <div class="p-3 control-sidebar-content" style="">
            <h5>Список компонентов
                <button type="button" class="close m-0 text-white" data-widget="control-sidebar"
                        data-slide="true" role="button">
                    <span aria-hidden="true">×</span>
                </button>
            </h5>
            <hr class="mb-2">
            <div class="">
                <div v-for="menu in vrc.categories">
                    <h6 class="down-toggle cursor-pointer">{{ menu.name }}</h6>
                    <div class="mb-1 down-toggle-content cursor-pointer">

                        <div class="flex column pl-2" v-for="item in vrc.getComponents(menu.id)">
                            <div class="" @click="addComponent(item,$event)">

                                <div class="preview" v-if="item.preview">
                                    <img :src="item.preview" alt="" class="w-100">
                                </div>
                                <h6 class="down-toggle cursor-pointer">{{ item.name }}</h6>

                            </div>


                        </div>

                    </div>
                </div>
            </div>


        </div>

    </aside>
</template>

<script>
import RegisterComponents from "/resources/js/src/Views/components";

export default {
    name: "Aside-default",
    data() {
        return {
            menus: [],
            vrc: {},
        }
    },
    methods: {
        addComponent(item, e) {
            item = JSON.parse(JSON.stringify(item))
            item.path = this.vrc.generatePath(item)
            item.id = this.getIdRandom()

            this.storage.page.data[this.storage.page.currentContainer].setting.components.push(item)

            $('.control-sidebar').ControlSidebar('toggle')
            let imgtodrag = $(e.target);
            let cart

            cart = $(`#TabContent-${this.storage.page.currentContainer}`)
            if (imgtodrag) {
                let imgclone = imgtodrag.clone()
                    .offset({
                        top: imgtodrag.offset().top,
                        left: imgtodrag.offset().left
                    })
                    .css({
                        'opacity': '0.5',
                        'position': 'absolute',

                        'max-width': '200px',
                        'z-index': '100'
                    })
                    .appendTo($('body'))
                    .animate({
                        'top': cart.offset().top + 10,
                        'left': cart.offset().left + 10,
                        'width': 75,
                        'height': 75
                    }, 500, 'easeInOutExpo');


                imgclone.animate({
                    'width': 0,
                    'height': 0
                }, function () {
                    $(this).detach()

                });


            }


        },

    },
    mounted() {


        this.vrc = new RegisterComponents()


    },
}
</script>

<style scoped lang="scss">
.preview {

    width: 100%;
    border: 2px solid grey;

    &:hover {
        border: 2px solid red;
    }
}

.down-toggle-content {
    display: none;
}

.control-sidebar {
    overflow: hidden;
}

.card-body {
    img {
        border: 2px solid transparent;
        width: 100%;
    }

    img:hover {
        border: 2px solid red;
    }
}
</style>



