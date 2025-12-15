<template>
<div class="col-12">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label> Экран </label>
                            <mc-select v-model="item.setting.container" :selects="containers" class="form-control"></mc-select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label> Отступ сверху </label>
                            <mc-select v-model="item.setting.marginTop" :selects="margins.top" class="form-control"></mc-select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label> Отступ снизу </label>
                            <mc-select v-model="item.setting.marginBottom" :selects="margins.bottom" class="form-control"></mc-select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label> Дополнительный класс </label>
                            <mc-input v-model="item.setting.class"  class="form-control"></mc-input>
                        </div>
                    </div>
                </div>
</div>
</template>

<script>
export default {
    name: "setting-container",
    props: {
        item: Object,
    },
    data() {
        return {
            containers: [
                {id: 'container-fluid', name: 'Fluid'},
                {id: 'container', name: 'Container'},
                {id: 'full', name: 'FullScreen'},
            ],
            margins: {
                top: [
                    {id: 'mt-0', name: 0},
                    {id: 'mt-1', name: 1},
                    {id: 'mt-2', name: 2},
                    {id: 'mt-3', name: 3},
                    {id: 'mt-4', name: 4},
                    {id: 'mt-5', name: 5},
                ],
                bottom: [
                    {id: 'mb-0', name: 0},
                    {id: 'mb-1', name: 1},
                    {id: 'mb-2', name: 2},
                    {id: 'mb-3', name: 3},
                    {id: 'mb-4', name: 4},
                    {id: 'mb-5', name: 5},
                ],
            },
        }
    },
}
</script>

<style scoped>

</style>
