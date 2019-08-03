<template>
    <div id='create-accounts' class=" d-flex justify-content-center align-items-center">
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <form method="POST" v-on:submit.prevent='post'>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input required v-model.lazy="name" name="name"  class="form-control" placeholder="Full name" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input required v-model.lazy="email"  name="email" class="form-control" placeholder="Email address" type="email">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                        </div>
                        <input required v-model.lazy="phone"  name="phone" class="form-control" placeholder="Phone number" type="text">
                    </div> <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select v-model="selectedtypes" class="form-control">
                            <option value="" selected>User Type</option>
                            <option v-for="user in usertypes" v-bind:key="user">{{user}}</option>
                        </select>
                    </div> <!-- form-group end.// -->


                    <div v-if="this.selectedtypes==='Lecturer'" class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <input required v-model.lazy="Department_id"  class="form-control" name="Department_id" placeholder="Department id" type="text">
                    </div> <!-- form-group// -->
                    

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input required v-model.lazy="password" v-on:change='passwordvalidater' class="form-control" name="password" placeholder="Create password" type="password">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input required v-model.lazy="repassword" v-on:change='passwordvalidater' name="repassword" class="form-control" placeholder="Repeat password" type="password">
                    </div> <!-- form-group// -->  

                    <div v-if="passwordvalidate" >
                        <p class="text-danger">{{passwordvalidate}}</p>
                    </div>                  

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
                    </div> <!-- form-group// -->                         
                </form>
            </article>
        </div> <!-- card.// -->
        <div v-if="errors" class="ml-5">
            <div v-for="error in errors" v-bind:key="error" class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{error}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div v-if="success" class="ml-5">
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{success}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
    data(){
        return {
            name:'',
            email:'',
            phone:'',
            usertype:'',
            password:'',
            repassword:'',
            usertypes:['Lecturer','Operator'],
            selectedtypes:'',
            passwordvalidate:"",
            Department_id:'',
            errors:[],
            success:''

        }
    },
    methods:{
        passwordvalidater:function(){
             if(this.password!==this.repassword){
                this.passwordvalidate='Passwords does not match'
            }else{
                this.passwordvalidate=null;
            }
        },
        post:function(){
           if(!this.passwordvalidate){
               this.$http.post('http://bcas.localhost/api/admin/user',{
                   name:this.name,
                   email:this.email,
                   phone:this.phone,
                   usertype:this.selectedtypes,
                   password:this.repassword,
                   Department_id:this.Department_id
               }).then((data)=>{
                   console.log(data);
                  this.success=data.body;
                  
               }).catch((error)=>{
                   console.log(error);
                   
                   Object.values(error.body.errors).forEach((e)=>{
                      e.forEach((x)=>{
                           this.errors.push(x)
                       });
                   });
    
               })
           }
        }
    }
   

}
</script>