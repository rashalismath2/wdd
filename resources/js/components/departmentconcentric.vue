<template>
  <div>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Department Concentric</h5>
    </div>
    <div class="modal-body">
      <div>
        <table class="table">
          <tbody>
            <tr>
              <th scope="col">Department</th>
              <th scope="col">
                <select
                  v-model="department"
                  style="width:180px"
                  class="form-control"
                  id="exampleFormControlSelect1"
                >
                  <option
                    v-for="department in departments"
                    v-bind:key="department.id"
                  >{{department.title}}</option>
                </select>
              </th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer">
      <button
        v-on:click="showresult"
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#showresult2"
      >Show</button>
      <a
        v-if="url"
        href="http://bcas.localhost/admin/getdepartmentsavedata"
        class="btn btn-primary"
      >Save</a>
    </div>
    <!-- ------------------------------------------------- -->
    <div
      class="modal fade"
      id="showresult2"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="min-width:600px">
          <div class="modal-body">
            <table id="scheduledepartment" class="table">
              <thead>
                <tr>
                  <th scope="col">Day</th>
                  <th scope="col">Lecturer</th>
                  <th scope="col">Time</th>
                  <th scope="col">Resource</th>
                  <th scope="col">Batch</th>
                </tr>
              </thead>
              <tbody v-if="schedule">
                <tr>
                  <td scope="row">{{schedule.day}}</td>
                  <td scope="row">{{schedule.name}}</td>
                  <td scope="row">{{schedule.time}}</td>
                  <td scope="row">Floor: {{schedule.floor_number}} Room: {{schedule.room_no}}</td>
                  <td scope="row">{{schedule.batch_id}}</td>
                </tr>
              </tbody>
              <tbody v-else>
                <td>No Data found</td>
              </tbody>
            </table>
            <div><button v-on:click="print('scheduledepartment')" class="btn btn-primary">Print</button></div>
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
      .get("http://bcas.localhost/api/admin/getdepartments")
      .then(function(data) {
        console.log("departments ", data);
        this.departments = data.body;
      })
      .catch(e => {
        console.log("getting department error ", e);
      });
  },
  data() {
    return {
      departments: [],
      department: "",
      schedule: [],
      url: ""
    };
  },
  methods: {
    showresult() {
      this.$http
        .post("http://bcas.localhost/api/admin/getdepartmentreport", {
          department: this.department
        })
        .then(function(data) {
          console.log("results of department report", data);
          this.schedule = data.body[0];
          this.savedepartmentdata();
        })
        .catch(e => {
          console.log("getting result error ", e);
        });
    },
    print(schedule){
        var printable=document.getElementById(schedule);
           var newWin= window.open("");
            newWin.document.write(printable.outerHTML);
            newWin.print();
            newWin.close();
    },
    savedepartmentdata() {
      this.$http
        .post("http://bcas.localhost/api/admin/savedepartmentdata", {
          department: this.department
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
};
</script>
