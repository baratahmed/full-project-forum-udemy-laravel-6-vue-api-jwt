<template>
     <v-container>
    
    <v-form @submit.prevent="submit" >

    <v-text-field
      v-model="form.name"
      label="Category Name"
      type="text"
      required
    ></v-text-field>

    <v-btn color="pink" class="mr-4" type="submit" v-if="editSlug">Update</v-btn>
    <v-btn color="teal" class="mr-4" type="submit" v-else>Create</v-btn>
  </v-form>


  <v-card>
        <v-toolbar color="indigo" dark dense class="mt-2">
            <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>

        <v-list >
            <div v-for="(category,index) in categories" :key="category.id">
                <v-list-item >
                <v-list-item-icon>
                    <v-btn icon @click="edit(index)">
                        <v-icon color="orange">mdi-pencil</v-icon>
                    </v-btn>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title>{{category.name}}</v-list-item-title>
                </v-list-item-content>

                <v-list-item-icon>
                    <v-btn icon @click="destroy(category.slug,index)">
                        <v-icon color="red">mdi-delete</v-icon>
                    </v-btn>
                </v-list-item-icon>
            </v-list-item>

             <v-divider></v-divider>
            </div>
        </v-list>
    </v-card>
  </v-container>
</template>
<script>

    export default {

       data(){
            return{
                form: {
                    name: null                   
                },
                categories: {},
                errors:{},
                editSlug: null,
                
            }
        },
        created(){

            // Optional
            if(!User.admin()){
                this.$router.push('/forum')
            }

            axios.get('/api/category')
            .then(res => this.categories = res.data.data)
        },
        methods:{
            submit(){
                this.editSlug ? this.update() : this.create()
            },
            create(){
                axios.post('/api/category', this.form)
                .then(res => {
                    this.categories.unshift(res.data);
                    this.form.name = null;
                })
                .catch(error => this.errors = error.response.data.errors)
            },
            update(){
                 axios.patch(`/api/category/${this.editSlug}`, this.form)
                 .then(res => {
                    this.categories.unshift(res.data);
                    this.form.name = null;
                })
                .catch(error => this.errors = error.response.data.errors)
            },
            destroy(slug,index){
                axios.delete(`/api/category/${slug}`)
                .then(res => this.categories.splice(index,1))
            },
            edit(index){
                this.form.name = this.categories[index].name
                this.editSlug = this.categories[index].slug
                this.categories.splice(index,1)

            }
        },
    }
</script>

<style>
    
</style>
