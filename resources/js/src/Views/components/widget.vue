<template>
    <div class="card mt-3 ">
        <div class=" flex column gab-10">
            <div v-if="load" id="litepms"><a href="https://litepms.ru/">система управления гостиницей, хостелом, апартаментами</a></div>

<!--            <div class="flex jc-sb ai-center">-->
<!--                <label class="label-text">Въезд</label>-->
<!--                <span class="label-desc flex ai-center gab-5">27 - 08 - 2025 <svg width="9" height="5"-->
<!--                                                                                  viewBox="0 0 9 5"-->
<!--                                                                                  fill="none"-->
<!--                                                                                  xmlns="http://www.w3.org/2000/svg">-->
<!--<path-->
<!--    d="M4.50009 4.93749C4.39619 4.93749 4.29219 4.89778 4.21287 4.81846L0.150368 0.755963C-0.0083745 0.597221 -0.0083745 0.340167 0.150368 0.181526C0.30911 0.0228855 0.566164 0.0227839 0.724805 0.181526L4.50009 3.95681L8.27537 0.181526C8.43411 0.0227839 8.69116 0.0227839 8.84981 0.181526C9.00845 0.340268 9.00855 0.597323 8.84981 0.755963L4.78731 4.81846C4.70798 4.89778 4.60398 4.93749 4.50009 4.93749Z"-->
<!--    fill="#222222"/>-->
<!--</svg>-->
<!--</span>-->
<!--            </div>-->
<!--            <div class="flex jc-sb ai-center">-->
<!--                <label class="label-text">Выезд</label>-->
<!--                <span class="label-desc flex ai-center gab-5">30 - 08 - 2025 <svg width="9" height="5"-->
<!--                                                                                  viewBox="0 0 9 5"-->
<!--                                                                                  fill="none"-->
<!--                                                                                  xmlns="http://www.w3.org/2000/svg">-->
<!--<path-->
<!--    d="M4.50009 4.93749C4.39619 4.93749 4.29219 4.89778 4.21287 4.81846L0.150368 0.755963C-0.0083745 0.597221 -0.0083745 0.340167 0.150368 0.181526C0.30911 0.0228855 0.566164 0.0227839 0.724805 0.181526L4.50009 3.95681L8.27537 0.181526C8.43411 0.0227839 8.69116 0.0227839 8.84981 0.181526C9.00845 0.340268 9.00855 0.597323 8.84981 0.755963L4.78731 4.81846C4.70798 4.89778 4.60398 4.93749 4.50009 4.93749Z"-->
<!--    fill="#222222"/>-->
<!--</svg>-->
<!--</span>-->
<!--            </div>-->
<!--            <div class="flex jc-sb ai-center">-->
<!--                <label class="label-text">Кол-во гостей</label>-->
<!--                <span class="label-desc flex ai-center gab-5">2 взрослых <svg width="9" height="5"-->
<!--                                                                              viewBox="0 0 9 5"-->
<!--                                                                              fill="none"-->
<!--                                                                              xmlns="http://www.w3.org/2000/svg">-->
<!--<path-->
<!--    d="M4.50009 4.93749C4.39619 4.93749 4.29219 4.89778 4.21287 4.81846L0.150368 0.755963C-0.0083745 0.597221 -0.0083745 0.340167 0.150368 0.181526C0.30911 0.0228855 0.566164 0.0227839 0.724805 0.181526L4.50009 3.95681L8.27537 0.181526C8.43411 0.0227839 8.69116 0.0227839 8.84981 0.181526C9.00845 0.340268 9.00855 0.597323 8.84981 0.755963L4.78731 4.81846C4.70798 4.89778 4.60398 4.93749 4.50009 4.93749Z"-->
<!--    fill="#222222"/>-->
<!--</svg>-->
<!--</span>-->
<!--            </div>-->
<!--            <Btn>Подобрать варианты</Btn>-->
        </div>
    </div>
</template>

<script>
export default {
name: "widget",
    data(){
    return{
        load:false
    }
    },
    mounted() {

        const script = document.createElement('script');
        script.src = 'https://litepms.ru/js/widget.js';
        document.head.appendChild(script);
        this.load = true
    }
}
</script>

<style scoped lang="scss">
.card {
    border-radius: 20px;
}
</style>
