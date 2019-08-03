<template>
  <div id="manage" class="d-flex justify-content-center align-items-center">
    <div class="boxes">
      <router-link to="/admin/create-account" exact>
        <p>Create Account</p>
      </router-link>
    </div>
    <div class="boxes">
      <router-link to="/admin/delete-account" exact>
        <p>Delete Account</p>
      </router-link>
    </div>
    <div class="boxes">
      <p class="text-white" v-on:click="clearschedule">Clear schedules</p>
    </div>

    <div class="boxes text-white" data-toggle="modal" data-target="#exampleModal">Generate reports</div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:min-content">
          <!-- ------------------------------------------------- -->
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Batch Concentric</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="col">Department</th>
                    <th scope="col">
                      <select
                        style="width:180px"
                        v-model="department"
                        class="form-control"
                        id="exampleFormControlSelect1"
                      >
                        <option
                          v-for="department in departments"
                          v-bind:key="department.id"
                        >{{department.title}}</option>
                      </select>
                    </th>
                    <th scope="col">Batch</th>
                    <th scope="col" v-if="department">
                      <select
                        v-model="batch"
                        style="width:60px"
                        class="form-control"
                        id="exampleFormControlSelect1"
                      >
                        <option v-for="batch in batches" v-bind:key="batch.id">{{batch.batch_id}}</option>
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
              data-target="#showresult"
            >Show</button>
            <a
              v-if="url"
              href="http://bcas.localhost/admin/getsavedata"
              class="btn btn-primary"
            >Save</a>
          </div>

          <!-- Modal -->
          <div
            class="modal fade"
            id="showresult"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header"></div>
                <div class="modal-body">
                  <table id="schedulebatch" class="table">
                    <thead>
                      <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Lecturer</th>
                        <th scope="col">Time</th>
                        <th scope="col">Resource</th>
                      </tr>
                    </thead>
                    <tbody v-if="schedule[0]">
                      <tr v-for="schedule in schedule" v-bind:key="schedule.id">
                        <td scope="row">{{schedule.day}}</td>
                        <td scope="row">{{schedule.name}}</td>
                        <td scope="row">{{schedule.time}}</td>
                        <td scope="row">Floor: {{schedule.floor_number}} Room: {{schedule.room_no}}</td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <td>No Data found</td>
                    </tbody>
                  </table>
                  <div>
                    <button v-on:click="print('schedulebatch')" class="btn btn-primary">Print</button>
                  </div>
                </div>
                <div class="modal-footer"></div>
              </div>
            </div>
          </div>
          <!-- ---------------- ------------------------------->
          <departmentconcentric></departmentconcentric>
           <lecturerconcentric></lecturerconcentric>
          <!-- ---------------- -->
        </div>
      </div>
    </div>
  </div>

  <!-- </div> -->
</template>

<script>
import XLSX from "xlsx";
import departmentconcentric from "../departmentconcentric.vue";
import lecturerconcentric from "../lecturerconcentric.vue";

export default {
  components: {
    Departmentconcentric: departmentconcentric,
    lecturerconcentric: lecturerconcentric,
  },
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
      batches: [],
      batch: "",
      schedule: [],
      url: ""
    };
  },
  watch: {
    department: function() {
      this.$http
        .post("http://bcas.localhost/api/admin/getbatchesforreports", {
          department: this.department
        })
        .then(function(data) {
          console.log("batches ", data);
          this.batches = data.body;
        })
        .catch(e => {
          console.log("getting batches error ", e);
        });
    }
  },
  methods: {
    clearschedule() {
      if (window.confirm("Are you sure?")) {
        this.$http
          .get("http://bcas.localhost/api/admin/clearschedule")
          .then(data => {
            console.log(data);
            window.alert("Schedule cleared");
          })
          .catch(e => {
            console.log(e);
          });
      }
    },
    print(schedule) {
      var printable = document.getElementById(schedule);
      var newWin = window.open("");
      newWin.document.write(printable.outerHTML);
      newWin.print();
      newWin.close();
    },
    save() {
      this.$http
        .post("http://bcas.localhost/api/admin/savedata", {
          department: this.department,
          batch: this.batch
        })
        .then(function(data) {
          console.log("results", data);
          this.url = data.body;
          //
        })
        .catch(e => {
          console.log("getting result error ", e);
        });
    },
    showresult() {
      this.$http
        .post("http://bcas.localhost/api/admin/getbatchreport", {
          department: this.department,
          batch: this.batch
        })
        .then(function(data) {
          console.log("results", data);
          this.schedule = data.body;
          this.save();
        })
        .catch(e => {
          console.log("getting result error ", e);
        });
    }
  }
};
</script>
