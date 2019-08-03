<template>
    <div id="admin-dashboard" >
        <nav-bar></nav-bar>
        <div id='main-area'>
            <admin-side-panel v-if="data.type==='admin'" v-bind:data="this.data"></admin-side-panel>
            <operator-side-panel v-if="data.type==='operator'" v-bind:data="this.data"></operator-side-panel>
            <lecturer-side-panel v-if="data.type==='lecturer'" v-bind:data="this.data"></lecturer-side-panel>
            <router-view></router-view>
        </div>
        <footerr></footerr> 
    </div>
</template>

<script>

    import Nav from '../Nav.vue';
    import Footer from '../Footer.vue';
    import adminsidepanel from './admin-side-panel.vue';
    import lecturersidepanel from '../lecturer/lecturer-side-panel.vue';
    import operatorsidepanel from '../operator/operator-side-panel.vue';
    import manage from './manage.vue';

    export default {
      components:{
          'nav-bar':Nav,
          'footerr':Footer,
          'admin-side-panel':adminsidepanel,
          'lecturer-side-panel':lecturersidepanel,
          'operator-side-panel':operatorsidepanel,
          'manage':manage,
      },
      props:{
          data:{
              type:Object,
              required:true
          },
    
      },
      created(){
        //   console.log(this.data);
      }
    }
</script>
