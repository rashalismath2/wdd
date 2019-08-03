<template>
    <div id='getschedule' class=" d-flex flex-column justify-content-center align-items-start">

      <div  class="container mt-5">
            <table  class="table table-striped bg-white">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Day</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Lecturer</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody v-if="!data['Message']">
                    <tr v-for="dat in data" v-bind:key="dat.id">
                        <th>{{dat.date}}</th>
                        <th>{{dat.time}}</th>
                        <th>{{dat.day}}</th>
                        <th>{{dat.title}} {{dat.batch_id}}</th>
                        <th>{{dat.name}}</th>
                        <th><span class="badge badge-info">{{dat.onetime | schedulestatus}}</span></th>
                    </tr>
                </tbody>
                <tbody v-else>
                    <h3 class="warning">
                        <strong>No data found</strong>
                    </h3>
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
            this.$http.post('http://bcas.localhost/api/admin/getdata',{
                floornumber:this.$route.params.floornum,
                roomnumber:this.$route.params.roomnum,
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