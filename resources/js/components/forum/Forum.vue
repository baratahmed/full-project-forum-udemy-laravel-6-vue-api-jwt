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
                questions:{}
              }
            },

            components:{Question,AppSidebar},
            
            created(){
            axios.get('api/question')
            .then(res => this.questions = res.data.data)
            .catch(error => console.log(error.response.data))
        }
    }
</script>

<style>
    
</style>
