<template>
    <div class="d-flex flex-column py-4 px-0" id='side-panel'>
        <div id="user " class=" d-flex justify-content-center flex-column align-items-center">     
            <i class="fas fa-user fa-5x mb-2"></i>
            <p v-if='data.user.name' class="text-white">{{this.data.user.name |format-name}}</p>
        </div>
        <div id="options" class=" d-flex justify-content-center flex-column align-items-center  pt-4">
            <button class="btn panel-btn"><router-link to="/operator/Manage" exact>Manage</router-link></button>
            <button class="btn panel-btn"><router-link to="/operator/schedule" exact>Schedule</router-link></button>
            <button  class="btn panel-btn"><router-link to="/operator/allocate" exact>Allocate Halls</router-link></button>
            <a class="btn panel-btn" href='http://bcas.localhost/operator/logout'>Logout</a>
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
        }
    }
</script>