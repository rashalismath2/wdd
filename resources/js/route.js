import manage from './components/admin/manage.vue';
import createaccount from './components/admin/create-account.vue';
import deleteaccount from './components/admin/delete-account.vue';

import allocate from './components/allocate.vue';
import allocatemain from './components/allocate-main.vue';
import bookhall from './components/bookhall.vue';

import schedule from './components/schedule.vue';
import schedulemain from './components/schedule-main.vue';
import getschedule from './components/getschedule.vue';
//----------------------- admin

import lecschedule from './components/lecturer/schedule.vue';
import lecschedulemain from './components/lecturer/schedule-main.vue';
import lecgetschedule from './components/lecturer/getschedule.vue';

//-----------------------------------operator
import scheduleoperator from './components/operator/schedule.vue';
import allocateoperator from './components/operator/allocate.vue';
import allocatemainoperator from './components/operator/allocate-main.vue';
import bookhalloperator from './components/operator/bookhall.vue';
import schedulemainoperator from './components/operator/schedule-main.vue';
import getscheduleoperator from './components/operator/getschedule.vue';
import operatormanage from './components/operator/manage.vue';


export default [

 
    {path:'/admin',component:manage},
    {path:'/admin/manage',component:manage},

    {path:'/admin/create-account',component:createaccount},
    {path:'/admin/delete-account',component:deleteaccount},

    {path:'/admin/allocate',component:allocate},
    {path:'/admin/allocate/floor/:floornum',component:allocatemain},
    {path:'/admin/allocate/floor/:floornum/book/:roomnum',component:bookhall},

    {path:'/admin/schedule',component:schedule},
    {path:'/admin/schedule/floor/:floornum',component:schedulemain},
    {path:'/admin/schedule/floor/:floornum/room/:roomnum',component:getschedule},
    //--------------------------------------- admin

    // {path:'/lecturer',component:lecgetschedule},
    {path:'/lecturer/:lectid/schedule',component:lecgetschedule},
    // {path:'/lecturer/:lectid/schedule/floor/:floornum',component:lecschedulemain},
    // {path:'/lecturer/:lectid/schedule/floor/:floornum/room/:roomnum',component:lecgetschedule},
    
    //----------------------------------------------------------------------------operator


    {path:'/operator',component:scheduleoperator},
    {path:'/operator/allocate',component:allocateoperator},
    {path:'/operator/allocate/floor/:floornum',component:allocatemainoperator},
    {path:'/operator/allocate/floor/:floornum/book/:roomnum',component:bookhalloperator},

    {path:'/operator/schedule',component:scheduleoperator},
    {path:'/operator/schedule/floor/:floornum',component:schedulemainoperator},
    {path:'/operator/schedule/floor/:floornum/room/:roomnum',component:getscheduleoperator},
    
    {path:'/operator',component:operatormanage},
    {path:'/operator/manage',component:operatormanage},
    
]