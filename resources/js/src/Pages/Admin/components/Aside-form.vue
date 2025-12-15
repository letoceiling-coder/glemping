<template>


        <div class="p-3 control-sidebar-content" style="">
            <h5>Список полей формы
                <button type="button" class="close m-0 text-white" data-widget="control-sidebar"
                        data-slide="true" role="button">
                    <span aria-hidden="true">×</span>
                </button>
            </h5>
            <hr class="mb-2">
            <div class="">
                <div v-for="form in forms">
                    <h6 class="down-toggle cursor-pointer">{{ form.name }}</h6>
                    <div class="mb-1 down-toggle-content cursor-pointer">

                        <div class="flex column pl-2" v-for="input in form.inputs">
                            <div class="" @click="addComponent(input,$event)">
                                <h6 class="down-toggle cursor-pointer">{{ input.name }}</h6>

                            </div>


                        </div>

                    </div>
                </div>
            </div>


        </div>


</template>

<script>
import RegisterComponents from "/resources/js/src/Views/components";

export default {
    name: "Aside-default",
    data() {
        return {
            forms: [
                {
                    id:1,
                    name:'Поля Формы',
                    inputs:[
                        {
                            id: 'mc-input',
                            name: 'Строковое поле',
                            label: 'Имя',
                            type: 'text',
                        },

                        {
                            id: 'mc-phone',
                            name: 'Телефон',
                            label: 'Телефон',
                            type: '',
                        },
                        {
                            id: 'mc-input',
                            name: 'E-mail',
                            label: 'E-mail',
                            type: 'email',
                        },
                        {
                            id: 'mc-data-picker',
                            name: 'Дата',
                            label: 'Дата',
                            type: '',

                        },
                        {
                            id: 'mc-data-picker-range',
                            name: 'Дата диапазон',
                            label: 'Дата',
                            type: '',
                            options:{
                                disabledWeekDays:[0],
                                addDays:0,
                                minDate : new Date(),
                            }
                        },
                        {
                            id: 'mc-input',
                            name: 'Числовое поле',
                            label: 'Колличество',
                            type: 'number',
                            min:1,
                            max:100,
                        },
                        {
                            id: 'mc-textarea',
                            name: 'Текстовое поле',
                            label: 'Комментарий',
                            type: '',
                            rows: '3',
                            cols: '45',
                        },
                        {
                            id: 'mc-select',
                            name: 'Выбор из списка',
                            label: 'Выбор параметра из списка',
                            type: '',
                            selects:[]
                        },
                    ]
                }
            ],
            vrc: {},
        }
    },
    methods: {
        addComponent(item, e) {
            item = JSON.parse(JSON.stringify(item))


            this.storage.form.data[this.storage.form.currentRow].cols.push({id:this.storage.form.currentCol,data:item})

            $('.control-sidebar').ControlSidebar('toggle')
            let imgtodrag = $(e.target);
            let cart

            cart = $(`#TabContent-${this.storage.form.currentRow}-${this.storage.form.currentCol}`)
            console.log(`#TabContent-${this.storage.form.currentRow}-${this.storage.form.currentCol}`)
            console.log(cart)
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



