<template>
  <v-container>
    
    <v-form @submit.prevent="createQuestion" >
    <v-text-field
      v-model="form.title"
      label="Title"
      type="text"
      required
    ></v-text-field>

    <v-select
          :items="categories"
          v-model="form.category_id"
          
          item-text="name"
          item-value="id"
          label="Category"
          autocomplete
    ></v-select>

    <vue-simplemde v-model="form.body" ref="markdownEditor" />

    <v-btn
      color="success"
      class="mr-4"
      type="submit"
    >
      Create
    </v-btn>
  </v-form>
  </v-container>

</template>
<script>
    export default {
        data(){
            return{
                form: {
                    title: null,
                    category_id: null,
                    body:null,
                   
                },
                categories: {},
                errors:{},
            }
        },
        created(){
             axios.get('/api/category')
             .then(res => this.categories = res.data.data)
        },
        methods:{
            createQuestion(){
                axios.post('/api/question', this.form)
                .then(res => this.$router.push(res.data.path))
                .catch(error => this.errors = error.response.data.error)
            }
        },
    }
</script>

<style>
    
</style>
