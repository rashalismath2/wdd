<template>
    <div id='getschedule' class=" d-flex flex-column justify-content-center align-items-start">
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
                                <option v-for="batch in batches" v-bind:key='batch.id' >{{department}} {{batch.id}}</option>
                            </select>
                        </th>
                        <th>
                            <button class="btn btn-primary">Get</button>
                        </th>
                      </tr>
                </tbody>
            </table>
        </div>

      <div  class="container mt-5">
            <table  class="table table-striped bg-white">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Lecturer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="dat in data" v-bind:key="dat.id">
                        <th>{{dat.date}}</th>
                        <th>{{dat.time}}</th>
                        <th>{{dat.title}} {{dat.batch_id}}</th>
                        <th>{{dat.name}}</th>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
export default {
    created(){
        this.getdata();

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
            data:[]
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
 
    },
    computed:{
      
 
    },
    methods:{
          getdata(){
            this.$http.post('http://bcas.localhost/api/lecturer/getdata',{
                lecturerid:this.$route.params.lectid
            })
            .then(function(data){
                console.log(data.body);
                this.data=data.body;
            })
            .catch((e)=>{
                console.log("Get data error",e);
            })
        },



    }
 
}
</script>