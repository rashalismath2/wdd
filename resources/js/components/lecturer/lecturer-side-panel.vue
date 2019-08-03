<template>
    <div class="d-flex flex-column py-4 px-0" id='side-panel'>
        <div id="user " class=" d-flex justify-content-center flex-column align-items-center">     
            <i class="fas fa-user fa-5x mb-2"></i>
            <p v-if='data.user.name' class="text-white">{{this.data.user.name |format-name}}</p>
        </div>
        <div id="options" class=" d-flex justify-content-center flex-column align-items-center  pt-4">
            <button class="btn panel-btn"><router-link v-bind:to='this.url' exact>Schedule</router-link></button>
            <a class="btn panel-btn" href='http://bcas.localhost/lecturer/logout'>Logout</a>
        </div>
    </div>
</template>

<script>
    export default {
        
        props:{
            data:{
                type:Object,
                required:true
            }
        },
        data(){
            return{
                url:"/lecturer/"+this.data.user.id+"/schedule"
            }
        }
    }
</script>