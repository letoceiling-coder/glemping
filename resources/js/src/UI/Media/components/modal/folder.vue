<template>
    <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" id="modal-new-folder">
        <div class="modal-dialog modal-md">
            <div class="modal-content relative">

                <div class="modal-header">
                    <h5 class="modal-title">Новая папка</h5>
                    <button @click="this.modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">

                    <div class="flex-center column gab-20">
                        <mc-input v-model="form.name"  keys="name"  class="form-control"></mc-input>
                        <button @click="create" type="button" class="btn btn-outline-dark ">
                            Создать папку
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "folder",
    mounted() {
    let _ = this
        $(".modal").on("hidden.bs.modal", function () {
            _.form.name = ''
            _.form.slug = ''
            _.storage.errors = []
        });
    },
    methods: {

        async create() {
            this.form.slug = this.form.name
            await axios.post('/api/v1/folders', this.form).then(data => {
                if (data){
                    this.form.name = ''
                    this.form.slug = ''
                    this.storage.media.folders.push(data.data.data)
                    console.log(data.data.data)
                    this.storage.media.folders.sort((a, b) => (a.sort > b.sort) ? 1 : -1)
                    $('#modal-new-folder').modal('hide')
                }

            }).catch((error) => {
                console.log(error)

            })


        }
    },

    data() {
        return {
            form:{
                name: '',
                slug: '',
            }


        }
    }
}
</script>

<style scoped lang="scss">

</style>
