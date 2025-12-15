<template>
    <div class="col-3">
        <div class="input-group ">
            <input type="text" class="form-control my-color-picker" :value="modelValue" ref="myColorPicker"
                   @input="$emit('update:modelValue', $event.target.value)"
                   :class=" this.storage.errors.find(item => item.name === keys) ? 'is-invalid': ''"
                   v-bind="$attrs">


        </div>
    </div>


    <div ref="errors" class="error-block">
        <mc-error  :keys="keys"/>
    </div>
</template>

<script>
export default {
    name: "color-picker",
    props: {
        modelValue: {
            type:String,
            default:'#000000'
        },
        keys: String | null,

    },
    emits: ['update:modelValue'],
    watch:{
        modelValue(){
            if (this.modelValue && this.modelValue.length > 0 && this.storage.errors.find(item => item.name === this.keys)){
                let keys = this.keys
                $(this.$refs.errors).slideUp()
                this.storage.errors.splice(this.storage.errors.findIndex(function(err) {
                    return err.name === keys
                }),1)

            }
        }
    },
    data(){
        return{

        }
    },
    mounted() {
        let _ = this
        $(function() {
            $(".my-color-picker").colorpicker({


            });


        });
        $(this.$refs.myColorPicker).on('change',function (){
            _.$emit('update:modelValue', $(this).val())
        })

        if (!this.modelValue){
            this.$emit('update:modelValue', '#000000')
        }
        console.log(this.modelValue)
    }

};
</script>

<style lang="scss">
.evo-pop {
    z-index: 10000;
    width: 220px;
    padding: 3px 3px 0;
    background: #fff;
    border: 1px solid silver;
    border-radius: 5px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.evo-colorind, .evo-colorind-ie, .evo-colorind-ff {

    position: absolute;
    right: 15px;
    top: calc(50% - 9px);
}
</style>
