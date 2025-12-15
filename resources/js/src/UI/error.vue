<template>

    <div v-for="message in this.storage.errors">


         <span class="error  relative flex-column" v-if="message.name == keys">

            <p v-for="msg in message.message">

            {{ msg }}
        </p>
        </span>
    </div>


</template>

<script>
export default {
    name: "error",
    props:{
        keys:String|null
    }
}
</script>

<style scoped lang="scss">
.is-invalid{
    border:1px solid red!important;
}
.my-input:has(.error) {
    input{
        border:1px solid red!important;
    }
    span{
        padding-top: 3px;
    }
}
.error {
    color: red;
    font-size: 12px;
}


</style>
