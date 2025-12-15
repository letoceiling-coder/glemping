<template>
    <div class="card-header">
        <h3 class="card-title"> {{ data.name }}</h3>
    </div>
    <div class="card-body">
        <div>
            <span class="btn-grey-no-active" v-for="property in data.tags">{{ property.name }}</span>
        </div>
    </div>


</template>

<script>
export default {
    name: "index",
    props: {
        data: Object,
    }
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';
.card-header{

        background: #fff;

}
.btn-grey-no-active {
    margin-right: 1rem;
    margin-bottom: 1rem;
    display: inline-flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    @include adaptiv-font(14, 12);
    padding: 10px 20px;
    border: 1px solid #EFEFEF;
    color: #000;
    border-radius: 45px;
    transform: matrix(1, 0, 0, 1, 0, 0);
    transition: all 0.2s;
    background: #EFEFEF;

&:hover {
     border: 1px solid #387BFF;

     background: #387BFF;
     color: #E6EEFF;
 }
}
</style>
