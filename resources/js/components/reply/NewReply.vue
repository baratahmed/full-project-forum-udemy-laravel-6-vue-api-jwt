<template>
    <div class="mt-4">
        <vue-simplemde v-model="body" ref="markdownEditor" />

        <v-btn color="green" dark @click="submit">
           Reply
        </v-btn>
    </div>
</template>

<script>
    export default {
        props:['questionSlug'],
        data(){
            return{
                body:null, 
            }
        },
        created(){

        },
        methods:{
            submit(){
                axios.post(`/api/question/${this.questionSlug}/reply`, {body:this.body})
                .then(res =>{
                    this.body = '';
                    EventBus.$emit('newReply', res.data.reply);
                    window.scrollTo(0,0)
                })
            }
        },
        mounted() {
            
        }
    }
</script>

<style>
    
</style>
