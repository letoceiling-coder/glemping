<template>
    <div class="row">
        <div class="col-12" >

            <div class="card col-12">
                <div class="card-header">
                    <h5>{{ setting.label }}</h5>
                </div>
                <div class="card-body">
                    <div class="row flex ai-center">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{setting.descTop.label}}</label>
                                <div class="row">
                                    <div class="col-3">Ширина:</div>
                                    <div class="col-2"><mc-input class="form-control" v-model="setting.descTop.numerator"></mc-input></div>

                                </div>
                                <div class="row mt-2">
                                    <div class="col-3">Высота:</div>
                                    <div class="col-2">  <mc-input class="form-control" v-model="setting.descTop.denominator"></mc-input></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{setting.mobile.label}}</label>
                                <div class="row">
                                    <div class="col-3">Ширина:</div>
                                    <div class="col-2"><mc-input class="form-control" v-model="setting.mobile.numerator"></mc-input></div>

                                </div>
                                <div class="row mt-2">
                                    <div class="col-3">Высота:</div>
                                    <div class="col-2">  <mc-input class="form-control" v-model="setting.mobile.denominator"></mc-input></div>
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
name: "ratio",
    props: {
        setting: Object
    },
    data(){

    }
}
</script>

<style scoped>

</style>
