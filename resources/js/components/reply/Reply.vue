<template>
    <div class="mt-5">
          <v-card class="mx-auto" max-width="900">
                <v-card-title>
                    <div class="headline">{{data.user}}</div>
                    <div class="ml-2">said {{data.created_at}}</div>
                    <v-spacer></v-spacer>
                    <like :content="data"></like>
                </v-card-title>
                <v-divider></v-divider>

                <edit-reply :reply="data" v-if="editing"></edit-reply>

                <v-card-text v-else v-html="reply">                 
                </v-card-text>

                <v-divider></v-divider>

                <div v-if="!editing">
                    <v-card-actions v-if="own">
                    <v-btn icon small>
                        <v-icon color="orange" @click="edit">mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn icon small>
                        <v-icon color="red" @click="destroy">mdi-delete</v-icon>
                    </v-btn>
                </v-card-actions>
                </div>
          </v-card>
    </div>
</template>

<script>
import EditReply from './EditReply'
import Like from '../likes/Like'
    export default {
        components:{EditReply,Like},
        props:['data','index'],
        data(){
            return{
              editing: false,
              beforeEditReplyBody:'',
            }
        },
        computed:{
            own(){
                return User.own(this.data.user_id)
            },
            reply(){
                return md.parse(this.data.reply)
            }
        },
        created(){
            this.listen()
        },
        methods:{
            destroy(){
                EventBus.$emit('deleteReply',this.index)
            },
            edit(){
                this.editing = true;
                this.beforeEditReplyBody = this.data.reply;
            },
            listen(){
                EventBus.$on('cancelEditing',(reply)=>{
                     this.editing = false;
                     if(reply !== this.data.reply){
                        this.data.reply = this.beforeEditReplyBody;
                        this.beforeEditReplyBody = '';
                     }
                })
            }
        },
        mounted() {
            
        }
    }
</script>

<style>
    
</style>
