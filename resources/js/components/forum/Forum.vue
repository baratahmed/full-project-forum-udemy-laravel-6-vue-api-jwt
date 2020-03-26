<template>
  <v-container class="grey lighten-5">
    <v-row no-gutters>
      <v-col
        cols="12"
        sm="6"
        md="8"
      >
        <v-card
          class="pa-2"
          outlined
          tile
        >
          <question
            v-for="question in questions"
            :key="question.path"
            :data=question
          > </question>

           <div class="text-center">
              <v-pagination
                v-model="meta.current_page"
                :length="meta.last_page"
                @input="changePage"
              ></v-pagination>
            </div>
        </v-card>
      </v-col>

      <v-col
        cols="6"
        md="4"
      >
        <v-card
          class="pa-2"
          outlined
          tile
        >
          
        <app-sidebar>

        </app-sidebar>

        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import Question from './Question'
import AppSidebar from './AppSidebar'
    export default {
            data(){
              return{
                questions:{},
                meta:{},
              }
            },

            components:{Question,AppSidebar},          
            created(){
                this.fatchQuestions();
            },
            methods:{
              fatchQuestions(page){
                let url = page ? `/api/question?page=${page}` : '/api/question';
                axios.get(url)
                .then(res => {
                  this.questions = res.data.data
                  this.meta = res.data.meta
                })
                .catch(error => console.log(error.response.data))
              },
              changePage(page){
                this.fatchQuestions(page)
              }
            },  
    }
</script>

<style>
    
</style>
