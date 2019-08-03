<template>
    <nav id='nav' class="navbar navbar-expand-lg ">
        <i class="fas fa-home fa-3x mr-2"></i>
        <a class="navbar-brand" href="http://bcas.localhost/admin">DASHBOARD</a>
       
        <!-- drop down -->
        <div class="btn-group ml-auto">
            <button type="button" class="btn fas fa-cog fa-3x text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" type="button">Account</button>
                </div>
        </div>
    </nav>
</template>

<script>
   
    export default {
        data(){
            return{
              
            }
        }
    }
</script>
