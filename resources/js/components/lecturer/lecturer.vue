<template>
    <div class="dashboard" >
        <nav-bar></nav-bar>
        <div id='main-area'>
            <side-panel  v-bind:data='this.data'></side-panel>
            <router-view></router-view>
        </div>
        <footerr></footerr> 
    </div>
</template>

<script>

    import Nav from '../Nav.vue';
    import Footer from '../Footer.vue';
    import sidepanel from './lecturer-side-panel.vue';

    export default {
      components:{
          'nav-bar':Nav,
          'footerr':Footer,
          'side-panel':sidepanel,
      },
      props:{
          data:{
              type:Object,
              required:true
          }
      },
      created(){
        //   console.log(this.user);
      }
    }
</script>
