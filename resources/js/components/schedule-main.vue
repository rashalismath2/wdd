<template>
    <div  class="floor-main d-flex justify-content-center align-items-center">
        <div class="tree">
            <ul>
                <li>
                    <router-link to="/admin/allocate" href="#" v-html="getFloor"></router-link>
                    <ul>
                        <li>
                            <router-link v-bind:to="this.url+'/room/1'" exact>{{getPrefix}}1</router-link>
                        </li>
                        <li>
                            <router-link v-bind:to="this.url+'/room/2'" exact>{{getPrefix}}2</router-link>
                        </li>
                        <li>
                            <router-link v-bind:to="this.url+'/room/3'" exact>{{getPrefix}}3</router-link>
                        </li>
                        <li>
                            <router-link v-bind:to="this.url+'/room/4'" exact>{{getPrefix}}4</router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        
    </div>
</template>


<script>
export default {
    data(){
        return{
            id:this.$route.params.floornum,
            url:'/admin/schedule/floor/'+this.$route.params.floornum
        }
    },
    computed:{
        getFloor(){
           
            if(this.id==1){
                return "1<sup>st</sup> Floor";
            }
            if(this.id==2){
                return "2<sup>nd</sup> Floor";
            }
            if(this.id==3){
                return "3<sup>rd</sup> Floor";
            }
            if(this.id==4){
               return "4<sup>th</sup> Floor";
            }

        },
        getPrefix(){
             if(this.id==1){
                return "F";
            }
            if(this.id==2){
                return "S";
            }
            if(this.id==3){
                return "T";
            }
            if(this.id==4){
               return "Fth";
            }
        }
    }
}
</script>