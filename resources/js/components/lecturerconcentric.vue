<template>
  <div>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Lecturer Concentric</h5>
    </div>
    <div class="modal-body">
      <div>
        <table class="table">
          <tbody>
            <tr>
              <th scope="col">Lecturer</th>
                <select v-model="lecturer"  style="width:180px"
                  class="form-control"
                  id="exampleFormControlSelect1">
                    <option v-for="lecturer in lecturers" v-bind:key="lecturer.id">
                        {{lecturer.name}}
                    </option>
                </select>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer">
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#showresult3"
      >Show</button>
      <button
      v-on:click="downloadresult"
   
        class="btn btn-primary"
      >Save</button>
    </div>
    <!-- ------------------------------------------------- -->
    <div
      class="modal fade"
      id="showresult3"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="min-width:600px">
          <div class="modal-body">
            <table id="schedulelecturer" class="table">
              <thead>
                <tr>
                  <th scope="col">Day</th>
                  <th scope="col">Time</th>
                  <th scope="col">Department</th>
                  <th scope="col">Batch</th>
                  <th scope="col">Resource</th>
                </tr>
              </thead>
              <tbody v-if="schedule.length>0" >
                  <tr v-for="schedule in schedule" v-bind:key="schedule.id">
                      <td>{{schedule.day}}</td>
                      <td>{{schedule.time}}</td>
                      <td>{{schedule.title}}</td>
                      <td>{{schedule.batch_id}}</td>
                      <td>Floor:{{schedule.floor_number}} Room:{{schedule.room_no}}</td>
                  </tr>
              </tbody>
              <tbody v-else>
                   <!-- v-else -->
                <td>No Data found</td>
              </tbody>
            </table>
            <div><button v-on:click="print('schedulelecturer')" class="btn btn-primary">Print</button></div>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    this.$http
      .get("http://bcas.localhost/api/admin/getlecturer")
      .then(function(data) {
        console.log("lecturers ", data.body);
        this.lecturers = data.body;
      })
      .catch(e => {
        console.log("getting lecturers error ", e);
      });
  },
  data() {
    return {
        lecturers:[],
        lecturer:'',
        schedule:[],
        url:''
    }
  },
  watch:{
      lecturer(){
         console.log(this.lecturer);
          this.$http
        .post("http://bcas.localhost/api/admin/getscheduleforlecturer",{
            lecturer:this.lecturer
        })
        .then(function(data) {
            console.log("getscheduleforlecturer ", data.body);
            this.schedule = data.body;
        })
        .catch(e => {
            console.log("getting getscheduleforlecturer error ", e);
        });
      }
  },
  methods:{
      print(schedule){
        var printable=document.getElementById(schedule);
           var newWin= window.open("");
            newWin.document.write(printable.outerHTML);
            newWin.print();
            newWin.close();
    },
    downloadresult() {
      this.$http
        .post("http://bcas.localhost/admin/getsavedlecturerdata", {
          lecturer: this.lecturer
        })
        .then(function(data) {
          console.log("results", data);
          this.url = data.body;
          //
        })
        .catch(e => {
          console.log("getting result error ", e);
        });
    }
  }
}
</script>
