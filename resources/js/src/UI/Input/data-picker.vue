<template>
    <VueDatePicker ref="datepicker"
                   v-model="data"
                   locale="ru"
                   :min-date="options.minDate"

                   :enable-time-picker="false"
                   :disabled-week-days="options.disabledWeekDays"
                   :disabled-dates="disabledDates"
                   auto-apply></VueDatePicker>

    <div ref="errors" class="error-block">
        <mc-error :keys="keys"/>
    </div>


</template>

<script>
// https://vue3datepicker.com/props/modes/#range
// https://vue3datepicker.com/methods-and-events/events/
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

export default {
    name: "data-picker",
    components: {VueDatePicker},
    props: {
        modelValue: String | Number,
        keys: String | null,
        options: {
            type: Object, default: {
                'disabledWeekDays': [0],
                'minDate': null,//new Date()
                'addDays': 0,
            }
        }

    },
    watch: {
        data() {

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
        setTimeout(this.loadHtml, 1000);
        this.eventBus.on('UpdateDate', (dateString) => {


            this.data = new Date(Date.parse(dateString));


        })

        console.log(this.data)
    },
    methods: {
        loadHtml(){
            this.data = this.modelValue
        },
    },
    computed: {
        disabledDates() {
            let dates = [];
            if (this.options.addDays) {

                const today = new Date();
                dates.push(new Date(today.setDate(today.getDate())))
                for (let i = 0; i < this.options.addDays; i++) {
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
