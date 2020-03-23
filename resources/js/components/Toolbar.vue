<template> 
  <v-card
    color="green lighten-4"
    flat
    height="200px"
    tile
  > 
    <v-toolbar dense>
      <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->

      <v-toolbar-title>Tech Forum</v-toolbar-title>

      <v-spacer></v-spacer>
      <app-notification v-if="loggedIn"></app-notification>

        <div>
            <router-link
              v-for="item in items"
              :key="item.title"
              :to="item.to"
              v-if="item.show">

                <v-btn text>{{item.title}}</v-btn> 
            </router-link>
        </div>
    </v-toolbar>
  </v-card>
</template>
<script>
import  AppNotification from './AppNotification'
    export default {
        components:{AppNotification},
        data(){
            return{
              loggedIn: User.loggedIn(),
              items : [
              {title:'Forum', to:'/forum', show:true},
              {title:'Login', to:'/login', show: !User.loggedIn()},
              {title:'Ask Question', to:'/ask', show: User.loggedIn()},
              {title:'Category', to:'/category', show: User.admin()},
              {title:'Logout', to:'/logout', show: User.loggedIn()},
            ]
            }
        },
        created(){
          EventBus.$on('logout', ()=>{
            User.logout();
          })
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
    
</style>
