<template>



    <button @click="download" type="button" class="btn btn-outline-dark flex-center m-0">
        <span class="send"><slot>Загрузить файл</slot></span>
        <span class="spinner-container">
                        <span class="spinner-border spinner-border-sm"></span>
                    </span>
    </button>
    <input  id="download-file" type="file" name="file" accept="image/*" hidden @change="uploadImage($event)">

    <div ref="errors" class="error-block">
        <mc-error  :keys="keys"/>
    </div>
</template>

<script>
export default {
    name: "download-file",
    props: {
        modelValue: String | Number | null,
        keys: String | null,
        size: Object | null,
    },
    emits: ['update:modelValue'],
    computed: {
        value: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        }
    },
    data(){
        return{

        }
    },
    methods:{
        download(){
            $('#download-file').trigger('click')
        },
        async uploadImage (e) {
            $('.spinner-container ,#grayout').show()
            $('.send').hide()
            let data = new FormData();
            let file = document.getElementById('download-file').files[0];
            data.append('file', file);
            data.append('size', this.size);

            if (file){
                await axios.post('/api/v1/images/dropzone/store',data).then( (data) => {

                    if (data.data != undefined){
                        this.$emit('update:modelValue', data.data.data)
                    }

                }).finally(() => {
                    $('.spinner-container, #grayout').hide()
                    $('.send').show()

                });
            }



        },

    }
}
</script>

<style scoped>
.spinner-container {
    display: none;
}
</style>
