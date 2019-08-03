<template>
    <div id='timetable' class=" d-flex justify-content-center align-items-center">
   <div  class="container mt-5">
            <table  class="table table-striped bg-white">
                <thead>
                    <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Lecturer</th>
                        <th scope="col">Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th scope="row">
                            <select >
                                <!-- <option value="" selected>Month</option> -->
                                <!-- <option v-for="month in months" v-bind:key='month.id' v-bind:value="month" >{{month.month}}</option> -->
                            </select>
                        </th>
                      </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>