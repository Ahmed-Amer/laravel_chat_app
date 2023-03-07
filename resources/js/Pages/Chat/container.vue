<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import messageContainer from './messageContainer.vue';
import inputMessage from './inputMessage.vue';
import chatRoomSelection from './chatRoomSelection.vue';

export default {
    data() {
        return {
            chatRooms: [], //full
            currentRoom: [], //full //update
            messages: [] //full
        }
    },
    watch:{
        currentRoom(val , oldVal){
            if(oldVal.id){
                this.connect(oldVal);
            }
            
        }
    },
    methods: {
        connect() {
            if(this.currentRoom.id){
                let vm = this;
                this.getmessages();
                Echo.private('chat.' + this.currentRoom.id)
                .listen('.message.new', (e) => {
                    vm.getmessages();
                    // this.messages.push({
                    //     message: e.message.message,
                    //     user: e.user
                    // });
                });
            }

        },
        disconnect(room){
            Echo.leave('chat.' + this.room.id)
        },
        getRooms() {
            axios.get('/chat/rooms')
                .then(response => {
                    this.chatRooms = response.data;
                    this.setRoom(response.data[0]);
                })
                .catch(error => {
                    console.log(error);
                })
        },
        setRoom(room) {
            this.currentRoom = room;
            this.getmessages();
        },
        getmessages() {
            axios.get('/chat/rooms/' + this.currentRoom.id + '/messages')
                .then(response => {
                    this.messages = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    components: {
        AppLayout,
        messageContainer,
        inputMessage,
        chatRoomSelection
    },
    created() {
        this.getRooms();
    },
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <chat-room-selection v-if="this.currentRoom.id" :rooms="chatRooms" :currentRoom="currentRoom"
                    v-on:roomchanged="setRoom($event)" />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container :messages="messages" />
                    <input-message :room="this.currentRoom" @messagesent="getmessages" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
