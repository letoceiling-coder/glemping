<template>

    <div class="row card">
        <div class="card-header">
            <label>{{ setting.label }}</label>

        </div>
        <div class="col-12 card-body" >
            <div class="form-group">

                <div class="row ai-center" v-for="content in setting.content">

                    <div v-for="col in content.cols"
                         :class="`col-${12 / content.cols.length }`" >

                        <div class="col-12" v-if="content.cols.find(item => item?.link !== undefined)">
                            <label>Ссылка</label>

                            <mc-input  v-model="content.cols.find(item => item.link !== undefined).link" class="form-control"></mc-input>
                        </div>
                        {{ `content-${col.type}` }}
                        <component v-if="col.bgImage" is="content-image" :setting="col.bgImage"></component>
                        <component v-if="col?.type" :is="`content-${col.type}`" :setting="col"></component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        setting: Object
    }
}
</script>

<style scoped>

</style>
