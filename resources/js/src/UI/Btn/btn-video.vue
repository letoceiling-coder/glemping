<template>
    <button @click="showMedia" type="button" class="btn btn-outline-dark flex-center m-0" v-bind="$attrs">
        <slot>Выбрать файл</slot>
    </button>

    <div ref="errors" class="error-block">
        <mc-error :keys="keys"/>
    </div>

</template>

<script>


export default {
    props: {
        keys: String | null,
        modelValue: Object | String | Number,
        countFile: {type: Number, default: 1},
        format: {type: String, default: 'all'}
    },
    name: "btn-image",
    emits: ['update:modelValue'],
    methods: {

        showMedia() {

            if ($('.modal').hasClass('show')){
                this.storage.modal.on = true
                this.storage.modal.name = `#${$(' .show').attr('id')}`
                console.log(this.storage.modal)
                $(this.storage.modal.name).modal('hide')

            }

            this.storage.media.route = 'files'
            this.storage.media.folder = 3
            this.storage.media.filter.folder = 3
            this.storage.media.active = true
            this.storage.media.id = this.id
            this.storage.media.countFile = this.countFile
            console.log(this.modelValue)
            if (this.modelValue){
                this.storage.media.selected = Array.isArray(this.modelValue) ? this.modelValue : [this.modelValue]
            }else {
                this.storage.media.selected
            }

            $('#media').modal('show')

        },
        randomId() {
            this.id = Math.random().toString(16).slice(2)
            if ($(`#${this.id}`).length) {
                return this.randomId()
            }
            return `uid-${this.id}`;
        }

    },
    data() {
        return {
            id: this.randomId(),

        }
    },
    mounted() {
        let _ =  this
        $("#media").on("hidden.bs.modal", function () {
            _.storage.media.selected = []
            _.storage.media.active = false
            _.checkModal()

        });

        this.eventBus.on('updateVideo', (args) => {

            $('#media').modal('hide')
            this.checkModal()

            this.storage.media.folder = 1
            this.storage.media.filter.folder = 1
            this.storage.media.active = false
            args = JSON.parse(JSON.stringify(args))

            if (this.storage.media.id == this.id) {
                if (this.format == 'all' || !this.format) {

                    if (this.countFile == 1) {
                        this.$emit('update:modelValue', args[0])
                    } else {
                        this.$emit('update:modelValue', args)
                    }

                } else {
                    if (this.countFile == 1) {
                        if (this.format.includes('.')) {
                            let fields = this.format.split('.')
                            let image = {}
                            for (let i = 0; i < fields.length; i++) {
                                image[fields[i]] = args[0][fields[i]]
                            }
                            this.$emit('update:modelValue', image)

                        } else {
                            this.$emit('update:modelValue', args[0][this.format])
                        }
                    }else {
                        if (this.format.includes('.')) {

                            let fields = this.format.split('.')
                            let image = []
                            for (let ii = 0; ii < args.length; ii++) {
                                let img = {}
                                for (let i = 0; i < fields.length; i++) {
                                    img[fields[i]] = args[0][fields[i]]
                                }
                                image.push(img)
                            }

                            this.$emit('update:modelValue', image)

                        } else {
                            this.$emit('update:modelValue', args)
                        }
                    }

                }
            }

        })
    }
}
</script>

<style scoped>

</style>
