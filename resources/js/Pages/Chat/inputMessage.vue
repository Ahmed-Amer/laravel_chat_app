<script>
export default{
    props : ['room'],
    data(){
        return{
            message : ""
        }
    },
    methods:{
        sendMessage(){
            if(this.message == ""){
                return
            }
            axios.post('/chat/rooms/' + this.room.id + '/message', {
                message : this.message
            })
            .then(response => {
                if(response.status == 201){
                    this.message = "";
                    this.$emit('messagesent');
                }
            })
            .catch(error =>{
                console.log(error);
            })
        }
    }
}
</script>

<template>
    <div class="relative h-12 m-1">
        <div style="border-top: 1px solid #e6e6e6;" class="grid grid-cols-6">
            <input 
            type="text"
            v-model="message"
            @keyup.enter="sendMessage"
            placeholder="Say Something..."
            class="col-span-5 outline-none p-1">
            <button
            @click="sendMessage"
            class="bg-gray-500 hover:bg-blue-700 p-3 mt-0 rounded text-white">Send</button>
        </div>
    </div>
</template>
