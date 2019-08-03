<template>
    <div id='bookhall' class=" d-flex flex-column justify-content-center align-items-start">
        <div  class="container mt-5">
            <table  class="table table-striped bg-white">
                <thead>
                    <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Lecturer</th>
                        <th scope="col">Batch</th>
                        <th scope="col">?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th scope="row">
                            <select  v-model="month">
                                <option value="" selected>Month</option>
                                <option v-for="month in months" v-bind:key='month.id' v-bind:value="month" >{{month.month}}</option>
                            </select>
                        </th>
                        <th >
                            <select v-model="date">
                                <option value="" selected>Date</option>
                                <option v-for="date in dates" v-bind:key='date' >{{date}}</option>
                            </select>
                        </th>
                        <th >
                            <select v-model="time">
                                <option value="" selected>Time</option>
                                <option v-for="time in times" v-bind:key='time' >{{time}}</option>
                            </select>
                        </th>
                        <th >
                            <select v-model="lecturer">
                                <option value="" selected>Lecturer</option>
                                <option  v-for="lecturer in lecturers" v-bind:key='lecturer.id' >{{lecturer.name}}</option>
                            </select>
                        </th>
                        <th >
                            <select v-model="batch">
                                <option value="" selected>Batches</option>
                                <option v-for="batch in batches" v-bind:key='batch.id' >{{department}} {{batch.batch_id}}</option>
                            </select>
                        </th>
                        <th >
                            <button v-on:click="bookhall" class="btn btn-primary btn-sm">Add</button>
                            <button v-if="edit" v-on:click="edithall" class="btn btn-primary btn-sm">Edit</button>
                        </th>
                      </tr>
                </tbody>
            </table>
        </div>
        <div v-if="load" class="lds-roller mt-2 mx-auto"><div></div><div></div><div></div>
        <div></div><div></div><div></div><div></div><div></div></div>
    </div>
</template>

<script>
export default {
    created(){

        //lecturers
        this.$http.get('http://bcas.localhost/api/operator/getlecturer')
        .then((data)=>{
            data.body.forEach(lecturer => {
                this.lecturers.push({name:lecturer.name,id:lecturer.id})
            });

        })
        .catch((e)=>{
            console.log('Retureiving lecturers error',e);
        })


    },
    data(){
        return{
            lecturers:[],
            months:[
                {month:'January',id:1},
                {month:'February',id:2},
                {month:'March',id:3},
                {month:'April',id:4},
                {month:'May',id:5},
                {month:'June',id:6},
                {month:'July',id:7},
                {month:'August',id:8},
                {month:'September',id:9},
                {month:'October',id:10},
                {month:'November',id:11},
                {month:'December',id:12},
            ],
            month:'',
            dates:[],
            times:['Morning','Evening'],
            lecturer:'',
            batches:[],
            department:'',
            time:'',
            batch:'',
            date:'',
            load:false,
            calander:['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
            edit:false
            
        }
    },
    watch:{
       month:function(){
            if(this.month.month!=='Month'){
                let datecount=new Date(new Date().getFullYear(),this.month.id,0).getDate();
                console.log('datecount',datecount);
                this.dates=[];
            for(var i=0;i<datecount;i++){
                this.dates[i]=i+1;
            }
            console.log(this.dates);
        }
       },
       lecturer:function(){
           if(this.lecturer!=='Lecturer'){
                  this.batches=[];
                this.$http.post('http://bcas.localhost/api/operator/getbatches',{
                    lecturer:this.lecturer
                })
                .then((data)=>{
                    this.department=data.body.Department;
                    console.log('Batches',data);
                    data.body.Batches.forEach((batch)=>{
                        this.batches.push(batch);
                    })
                    
                })
                .catch((e)=>{
                    console.log('Fetching batch error',e);
                })
           }

       }
     
    },
    computed:{
      getLecturer(data){
          console.log(data);
      },
 
    },
    methods:{
        bookhall:function(){

            if(!this.time || !this.lecturer || !this.batch || !this.month || !this.date){
                window.alert('Please choose all the options')
            }else{
                this.load=true;
                var date=new Date();

                this.$http.post('http://bcas.localhost/api/operator/bookhall',{
                    time:this.time,
                    lecturer:this.lecturer,
                    department:this.batch.split(' ')[0],
                    batchid:this.batch.split(' ')[1],
                    date:date.getFullYear()+'/'+this.month.id+'/'+this.date,
                    floornum:this.$route.params.floornum,
                    roomnum:this.$route.params.roomnum,
                    day:this.calander[new Date(date.getFullYear()+'/'+this.month.id+'/'+this.date).getDay()],
                    onetime:false

                })
                .then((data)=>{
                    this.load=false;
                    window.alert(data.body.Message);
                    this.edit=data.body.Message.toLowerCase().includes('already');
                    console.log(data);
                })
                .catch((e)=>{
                    console.log('Book hall error',e);
                })
            }
        },
        edithall:function(){

            if(!this.time || !this.lecturer || !this.batch || !this.month || !this.date){
                window.alert('Please choose all the options')
            }else{
                this.load=true;
                var date=new Date();

                this.$http.post('http://bcas.localhost/api/operator/edithall',{
                    time:this.time,
                    lecturer:this.lecturer,
                    department:this.batch.split(' ')[0],
                    batchid:this.batch.split(' ')[1],
                    date:date.getFullYear()+'/'+this.month.id+'/'+this.date,
                    floornum:this.$route.params.floornum,
                    roomnum:this.$route.params.roomnum,
                    day:this.calander[new Date(date.getFullYear()+'/'+this.month.id+'/'+this.date).getDay()],
                    onetime:true

                })
                .then((data)=>{
                    this.load=false;
                    window.alert(data.body.Message);
                    this.edit=data.body.Message.toLowerCase().includes('already');
                    console.log("data",data);
                })
                .catch((e)=>{
                    console.log('Edit hall error',e);
                })
            }
        },

    }
 
}
</script>