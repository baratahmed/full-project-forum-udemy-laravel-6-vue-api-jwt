<template>
  <v-container>
    
    <v-form @submit.prevent="login" >
    <v-text-field
      v-model="form.email"
      label="E-mail"
      type="email"
      required
    ></v-text-field>

    <v-text-field
      v-model="form.password"
      label="Password"
      type="password"
    ></v-text-field>


    <v-btn
      color="success"
      class="mr-4"
      type="submit"
    >
      Login
    </v-btn>

    <router-link to="/signup">
        <v-btn color="blue">Signup</v-btn>
    </router-link>
  </v-form>
  </v-container>
</template>
<script>
    export default {
        data(){
            return{
                form: {
                    email: null,
                    password: null,
                }
            }
        },
        created(){
          if(User.loggedIn()){
            this.$router.push({name:'forum'})
          }
        },
        methods:{
            login(){
                User.login(this.form);
                //this.$router.push({name:'forum'})
            }
            // login(){
            //  axios.post('/api/auth/login',this.form)
            //     .then(res => console.log(res.data))
            //     .catch(error => console.log(error.response.data))
            // }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
    
</style>
