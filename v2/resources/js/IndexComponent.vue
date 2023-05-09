<template>
    <div>
        <header class="fs-4 d-flex justify-content-center mb-5 pb-1">
            <router-link to="/createAccount" class="header-link mx-5">Create Account</router-link>
            <router-link to="/deals" class="header-link mx-5">Deal</router-link>
            <router-link to="/linking" class="header-link mx-5">Linking</router-link>
        </header>
        <router-view ref="main"></router-view>
    </div>
</template>

<script>


export default {
    name: "IndexComponent",
    data(){
      return {
          accessToken:null
      }
    },
    mounted() {
    },
    methods:{

    }
}
</script>

<style scoped>

</style>
