<template>


    <div class="on-off">
        <input ref="myButton" :value="modelValue" type="checkbox" class="form-control"
               data-bootstrap-switch :checked="modelValue" v-bind="$attrs" >
        <div ref="errors" class="error-block">
            <mc-error  :keys="keys"/>
        </div>
    </div>
</template>

<script>
export default {
    name: "input-on-off",
    props: {
        modelValue: String | Number,
        keys: String | null,
    },

    emits: ['update:modelValue'],
    mounted() {
        $(this.$refs.myButton).each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
        let change = this.change
        $(this.$refs.myButton).on('switchChange.bootstrapSwitch', function (event, state) {
            change()
        });
    },
    watch: {
        modelValue() {
            if (this.storage.errors.find(item => item.name === this.keys)){
                let keys = this.keys
                $(this.$refs.errors).slideUp()
                this.storage.errors.splice(this.storage.errors.findIndex(function(err) {
                    return err.name === keys
                }),1)

            }
            $(this.$refs.myButton).bootstrapSwitch('state', this.modelValue)
        }
    },

    methods: {
        change() {
            this.$emit('update:modelValue', ($(this.$refs.myButton).bootstrapSwitch('state') === true))
        }
    },
}
</script>

<style scoped>

</style>
