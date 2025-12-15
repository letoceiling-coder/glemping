<template>

    <div  ref="mcHtml" class="summernote col-12" v-html="modelValue" v-bind="$attrs"></div>

    <div ref="errors" class="error-block">
        <mc-error  :keys="keys"/>
    </div>
</template>

<script>
// https://summernote.org/deep-dive/#onimagelinkinserta
export default {
    props: {
        modelValue: {type: String, default: ''},
        keys: String | null,
        options: {
            type: Object, default: {
                code: false,
                focus: false,
                reset: false,
                disableDragAndDrop: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],

            }
        }
    },
    emits: ['update:modelValue'],

    mounted() {
        let options = this.options

        $(this.$refs.mcHtml).summernote({
            minHeight: 100,
            maxHeight: 500,
            height: 100,
            lang: 'ru-RU',
            codemirror: {},
            toolbar: this.options.toolbar,
            disableDragAndDrop: this.options.disableDragAndDrop

        });
        $(this.$refs.mcHtml).on("summernote.change", this.change);
        if (this.options.code == true) {
            $(this.$refs.mcHtml).summernote('codeview.activate');
        } else {
            $(this.$refs.mcHtml).summernote('codeview.deActivate');
        }
        let $emit = this.$emit
        let mcHtml = $(this.$refs.mcHtml)
        $(this.$refs.mcHtml).on('summernote.blur.codeview', function () {
            $emit('update:modelValue', mcHtml.summernote('code'))
            options.focus = false

        });
        $(this.$refs.mcHtml).next().on('click', function (e) {
            options.focus = true

        });
        $(this.$refs.mcHtml).on('summernote.focus', function () {
            options.focus = true

        });
        $(this.$refs.mcHtml).on('summernote.blur', function () {
            options.focus = false


        });
        if (!this.eventBus.all.has('updateHtml')) {
            this.eventBus.on('updateHtml', (args) => {
                console.log(args)
                $(`#${args.id}`).summernote('code', args.html)
            })
        }

        setTimeout(this.loadHtml, 1000);

    },
    data() {
        return {

        }
    },

    methods: {
        loadHtml(){
            $(this.$refs.mcHtml).summernote('code', this.modelValue)
        },
        change() {
            this.$emit('update:modelValue', $(this.$refs.mcHtml).summernote('code'))

        }
    },
    watch: {
        // $('#summernote').summernote('reset')
        'options.reset': {
            handler: function (reset) {
                if (reset) {
                    $(this.$refs.mcHtml).summernote('reset')
                    reset = false
                }


            },
            deep: true,
            immediate: true
        },
        modelValue(){
            if (this.storage.errors.find(item => item.name === this.keys)){
                let keys = this.keys
                $(this.$refs.errors).slideUp()
                this.storage.errors.splice(this.storage.errors.findIndex(function(err) {
                    return err.name === keys
                }),1)

            }


        }
    }


}
</script>

<style scoped>

</style>
