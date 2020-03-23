<template>
    <div class="mt-4">
        <vue-simplemde v-model="reply.reply" ref="markdownEditor" />

        <v-card-actions>
            <v-btn icon small>
                <v-icon color="green" @click="update">mdi-content-save</v-icon>
            </v-btn>
            <v-btn icon small>
                <v-icon color="black" @click="cancel">mdi-cancel</v-icon>
            </v-btn>
        </v-card-actions>
    </div>
</template>

<script>
    export default {
        props: ['reply'],
        data(){
            return{

            }
        },
        created(){

        },
        methods:{
           update(){
               axios.patch(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,{body:this.reply.reply})
               .then(res => this.cancel(this.reply.reply))
           },
           cancel(reply){
               EventBus.$emit('cancelEditing',reply)
           }
        },
        mounted() {
            
        }
    }
</script>

<style>
    
</style>
