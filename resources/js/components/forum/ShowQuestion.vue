<template>
  <v-container>
      <v-card>
          <v-card-title>
              <div>
                <div class="headline">
                  {{data.title}}
                </div>
                <span class="grey--text small_text">{{data.user}} said {{data.created_at}}</span>
              </div>

          <v-spacer></v-spacer>
          
          <v-btn class="teal" dark>{{replyCount}} Replies</v-btn>
          </v-card-title>

          <v-card-text v-html="body">

          </v-card-text>

          <v-card-actions v-if="own">
            <v-btn icon @click="edit">
                <v-icon color="orange">mdi-pencil</v-icon>
            </v-btn>
            <v-btn icon @click="destroy">
                <v-icon color="red">mdi-delete</v-icon>
            </v-btn>
          </v-card-actions>
          

      </v-card>
  </v-container>
</template>
<script>
    export default {
        data(){
          return{
            own: User.own(this.data.user_id),
            replyCount: this.data.reply_count,
          }
        },
        props:['data'],
        computed:{
          body(){
            return md.parse(this.data.body)
          }
        },
        methods:{
          destroy(){
            axios.delete(`/api/question/${this.data.slug}`)
            .then(res => this.$router.push('/forum'))
            .catch(error => console.log(error.response.data))
          },
          edit(){
            EventBus.$emit('startEditing')
          },
        },
        created(){
          EventBus.$on('newReply',()=>{
              this.replyCount++;
          });
          Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.replyCount++;
          });
          EventBus.$on('deleteReply',()=>{
              this.replyCount--;
          });
          Echo.channel('deleteReplyChannel')
               .listen('DeleteReplyEvent',(e)=>{
                   this.replyCount--;
          })

        }
    }
</script>

<style >
    .small_text{
    font-size: 15px;
}
</style>
