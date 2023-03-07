<script>
export default{
    props : ['rooms' , 'currentRoom'],
    data(){
        return{
            selected : ""
        }
    },
    created(){
        this.selected = this.currentRoom
    }
}
</script>

<template>
    <div class="grid grid-cols-2">
        <div class="font-bold text-x1">
            {{ selected.name }} Chat
        </div>
        <div>
            <select 
            v-model="selected"
            @change="$emit('roomchanged' , this.selected)"
            class="float-right">
                <option
                v-for="(room , index) in rooms"
                :key="index" 
                :value="room"
                >
                {{ room.name }}
                </option>
            </select>
        </div>
    </div>
</template>
