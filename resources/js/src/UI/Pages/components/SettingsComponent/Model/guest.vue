<template>

    <div class="row">
        <div class="col-12" >
            <div class="form-group">

                <div class="card" >

                    <div class="card-body" >
                        <div class="form-group">
                            <label>Количество гостей</label>
                            <mc-input class="form-control" v-model="setting.data.guest"></mc-input>
                        </div>
                    </div>
                    <div class="card-body" >
                        <div class="form-group">
                            <label>Увеличивать каждые 2 часа на </label>
                            <mc-input class="form-control" v-model="setting.data.increase"></mc-input>
                        </div>
                    </div>
                    <div class="card-body" >
                        <button type="button" class="btn btn-sm btn-primary" @click="save">Сохранить  </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {notify} from "@kyvg/vue3-notification";

export default {
    props: {
        setting: Object
    },
    mounted() {
        this.setting.data = this.storage.settings.numberGuest
    },
    methods:{
        async save() {
            let url = `/api/v1/guest/count`
            await axios.post(url,this.setting.data).then(data => {
                console.log(data.data)
                this.storage.settings.numberGuest = data.data
                this.setting.data = data.data
                notify({
                    title: "Уведомление",
                    text: "Успешно",
                    type: "success",
                });
            }).catch((error) => {
                console.log(error)

            })


        },
    }
}
</script>

<style scoped>

</style>
