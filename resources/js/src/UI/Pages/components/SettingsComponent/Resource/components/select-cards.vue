<template>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>{{ setting.label }}</label>
                <mc-select class="form-control" :selects="VRC.getComponentsCard()" v-model="card"/>
            </div>
        </div>
    </div>
</template>

<script>
import VRC from "/resources/js/src/Views/components";

export default {
    name: "select-cards",
    props: {
        setting: Object
    },
    data() {
        return {
            VRC: new VRC(),
            card:0,
        }
    },
    mounted() {
        if (this.setting.data.id){
            this.card = this.setting.data.id
        }

    },
    watch:{
        card(value){
             this.setting.data = this.VRC.getComponentsCard().find(item => item.id == value)
            if (this.setting.data){
                this.setting.data.path = this.VRC.generatePath(this.setting.data)
                this.setting.data.fields = this.VRC.getFields(this.setting.data.component)
            }




        }
    }
}
</script>

<style scoped>

</style>
