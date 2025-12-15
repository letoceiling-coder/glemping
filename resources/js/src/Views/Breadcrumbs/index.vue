<template>
<ul class="breadcrumbs flex gab-10 ai-center">
    <li class="cursor-pointer">
        <svg  @click="this.$router.back()" width="26" height="16" viewBox="0 0 26 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.292892 7.29289C-0.0976315 7.68342 -0.0976315 8.31658 0.292892 8.70711L6.65685 15.0711C7.04738 15.4616 7.68054 15.4616 8.07107 15.0711C8.46159 14.6805 8.46159 14.0474 8.07107 13.6569L2.41421 8L8.07107 2.34315C8.46159 1.95262 8.46159 1.31946 8.07107 0.928932C7.68054 0.538408 7.04738 0.538408 6.65685 0.928932L0.292892 7.29289ZM26 8V7L1 7V8V9L26 9V8Z" fill="white"/>
        </svg>
    </li>

    <li class="cursor-pointer">
        <router-link to="/">ГЛАВНАЯ</router-link>
    </li>
    <li class="cursor-pointer">
        <svg width="8" height="2" viewBox="0 0 8 2" fill="none" xmlns="http://www.w3.org/2000/svg">
            <line x1="0.375977" y1="1.0169" x2="7.43959" y2="1.0169" stroke="white" stroke-width="0.642147"/>
        </svg>

    </li>
    <li class="cursor-pointer">
        <router-link to="/catalog">Каталог</router-link>
    </li>
    <li class="cursor-pointer" v-if="offer">
        <svg width="8" height="2" viewBox="0 0 8 2" fill="none" xmlns="http://www.w3.org/2000/svg">
            <line x1="0.375977" y1="1.0169" x2="7.43959" y2="1.0169" stroke="white" stroke-width="0.642147"/>
        </svg>

    </li>
    <li class=" active" v-if="offer" >
{{offer.name}}
    </li>


</ul>
</template>

<script>
export default {
    props:{
        offer:Object|null
    },
name: "index"
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';
.breadcrumbs{
    color: #FFFFFF;
}
.cursor-pointer{
    cursor:pointer;
    display: flex;
    align-items: center;
   a{
       font-family: 'Montserrat';
       font-style: normal;
       font-weight: 400;
       @include adaptiv-font(16, 8);
       line-height: 22px;
       text-transform: uppercase;
       color: #FFFFFF;
   }


}
.active{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    @include adaptiv-font(16, 10);
    line-height: 22px;
    text-transform: uppercase;
    color: #00BA57;


}
@media only screen and (max-width: 767px) {
svg{
    width: 16px;
}
    .gab-10{
        gap:3px;
    }
}
</style>
