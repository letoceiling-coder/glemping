<template>

    <VueDatePicker v-model="data"
                   locale="ru"
                   :min-date="options.minDate"

                   :enable-time-picker="false"
                   :disabled-week-days="options.disabledWeekDays"
                   :disabled-dates="disabledDates"
                   range auto-apply></VueDatePicker>

    <div ref="errors" class="error-block">
        <mc-error  :keys="keys"/>
    </div>
</template>

<script>
// https://vue3datepicker.com/props/modes/#range
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

export default {
    name: "data-picker",
    components: {VueDatePicker},
    props: {
        modelValue: String | Number,
        keys: String | null,
        options:{type:Object,default:{
                'disabledWeekDays':[0],
                'minDate' : new Date(),
                'addDays' : 0,
            }}

    },
    watch:{
        data(){

            this.$emit('update:modelValue', this.data)
        },
        modelValue() {
            if (this.modelValue && this.storage.errors.find(item => item.name === this.keys)) {
                let keys = this.keys
                $(this.$refs.errors).slideUp()
                this.storage.errors.splice(this.storage.errors.findIndex(function (err) {
                    return err.name === keys
                }), 1)

            }
        }
    },
    emits: ['update:modelValue'],

    data() {
        return {
            data: null,
        }
    },
    mounted() {

        this.data = this.modelValue
    },
    methods:{

    },
    computed: {
        disabledDates() {
            let dates = [];
            if (this.options.addDays){

                const today = new Date();
                dates.push(new Date(today.setDate(today.getDate() )))
                for (let i = 0; i < this.options.addDays ; i++) {
                    dates.push(new Date(today.setDate(today.getDate() + 1)))
                }


            }

            return dates;


        },
        minDate() {
            let today = new Date();
            let tomorrow = new Date();
            return new Date();

        },
    },
}
</script>

<style scoped>

</style>
