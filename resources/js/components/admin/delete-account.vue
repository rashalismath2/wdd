<template>
    <div id='delete-accounts' class=" d-flex flex-column justify-content-start align-items-center">
        <div class="container mt-3 d-flex flex-column justify-content-start align-items-center">
            <input type="text" v-model="keyword" name="" placeholder="Search names" id="searchbox" class="form-control align-self-center">
            <div id="search-element" class="p-2 mt-1" v-if="keyword">
                <div v-on:click="choosenuser(data)" v-for="data in searchfor" v-bind:key="data.email" class="search-result">
                    {{data.name}}
                </div>
            </div>
        </div>
        
        <div v-if="deletemessage" class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>{{this.deletemessage}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div v-if="chosenuser" class="container mt-5" id="filteruser">
            <table v-if="!userdeleted" class="table table-striped bg-white">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Type</th>
                        <th scope="col">?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th scope="row">{{chosenuser.id}}</th>
                        <td>{{chosenuser.name}}</td>
                        <td>{{chosenuser.email}}</td>
                        <td>{{chosenuser.created_at}}</td>
                        <td>{{chosenuser.Type}}</td>
                        <td><a v-on:click="deleteuser(chosenuser.id,chosenuser.Type)" class="btn btn-primary">Delete</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    
    </div>
</template>


<script>
    
    export default {
      data(){
          return{
                users:[],
                keyword:'',
                chosenuser:'',
                userdeleted:false,
                deletemessage:''
          }
      },
      beforeCreate(){
           
          this.$http.get('http://bcas.localhost/api/admin/query')
          .then((data)=>{
                data.body.lecturers.forEach((A)=>{
                    this.users.push(A)
                })
                data.body.operators.forEach((A)=>{
                      this.users.push(A)
                })

                console.log(this.users)

          })
          .catch((error)=>{
              console.log(error);
          })
      },
      methods:{
          choosenuser:function(data){
              this.chosenuser=data;
              this.userdeleted=false;
              this.deletemessage='';
            //   console.log(keyword);
          },
            deleteuser:function(userid,usertype) {
              if(window.confirm("Do you really want to delete the user?")){
                  console.log(userid,usertype);
                  this.$http.post('http://bcas.localhost/api/admin/deleteuser',{
                      userid:userid,
                      usertype:usertype
                  })
                  .then(function(reply){
                      this.userdeleted=true;
                      this.deletemessage=reply.body;
                      console.log(reply);
                  })
                  .catch((e)=>{
                      console.log('Error in delete user ',e);
                  })
              }
          }
         
      },
      computed:{
          searchfor:function(){
              return this.users.filter((data)=>{
                  return data.name.toLowerCase().match(this.keyword.toLowerCase());
              })
          },
         
          
      }

    }

</script>
