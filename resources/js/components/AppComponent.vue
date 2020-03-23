<template>
    <v-app>
        <app-toolbar></app-toolbar>
        <router-view></router-view>
        <app-footer></app-footer>
    </v-app>
</template>
<script>
import AppToolbar from './Toolbar'
import AppFooter from './Footer'
import AppLogin from './login/Login'
    export default {
        components: {AppToolbar,AppFooter,AppLogin},
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
    
</style>
