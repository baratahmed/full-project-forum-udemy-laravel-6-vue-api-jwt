<template>
  <v-container fluid>
      <v-card>
          <v-form @submit.prevent="updateQuestion" >
            <v-text-field
            v-model="form.title"
            label="Title"
            type="text"
            required
            ></v-text-field>

            <vue-simplemde v-model="form.body" ref="markdownEditor" />

            <v-card-actions >
                <v-btn icon type="submit">
                    <v-icon color="green">mdi-content-save</v-icon>
                </v-btn>
                <v-btn icon @click="cancel">
                    <v-icon color="red">mdi-cancel</v-icon>
                </v-btn>
            </v-card-actions>
        </v-form>
      </v-card>
  </v-container>
</template>
<script>
    export default {
        props: ['data'],
        data(){
            return{
                form: {
                    title: null,
                    body:null,
                   
                },
                errors:{},
            }
        },
        mounted(){
            this.form = this.data
        },
        methods:{
            cancel(){
                EventBus.$emit('cancelEditing')
            },
            updateQuestion(){
                axios.patch(`/api/question/${this.form.slug}`, this.form)
                .then(res => this.cancel())
            }
        }
    }
</script>

<style>
    
</style>
