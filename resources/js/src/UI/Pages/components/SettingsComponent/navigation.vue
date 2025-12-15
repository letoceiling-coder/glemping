
<template>

    <div class="row">
        <div class="col-12 card" v-for="menu in setting.data">
            <div class="card-body">
                <div class="form-group">
                    <label>Лейбл</label>
                    <mc-input v-model="menu.name" class="form-control"></mc-input>
                </div>
                <div class="col-12 card" >
                    <div class="card-header">Группа меню</div>
                    <div class="card-body" v-for="(item,indexItem) in menu.items">
                        <div class="row ai-center border p-2">
                            <div class="col-1">
                                <div class="form-group">
                                    <label >{{ indexItem + 1 }}</label>

                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Наименование</label>
                                    <mc-input v-model="item.name" class="form-control"></mc-input>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Ссылка</label>
                                    <mc-input v-model="item.slug" class="form-control"></mc-input>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "navigation",
    props: {
        setting: Object
    }
}
</script>

<style scoped>

</style>
