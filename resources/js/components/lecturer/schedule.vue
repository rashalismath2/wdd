<template>
    <div class="schedule d-flex justify-content-center align-items-center">
        <div class="tree">
            <ul>
                <li>
                    <a href="#">BCAS</a>
                    <ul>
                        <li>
                            <router-link v-bind:to="this.url+'/1'" exact>1<sup>st</sup> Floor</router-link>
                        </li>
                        <li>
                            <router-link v-bind:to="this.url+'/2'" exact>2<sup>nd</sup> Floor</router-link>
                        </li>
                        <li>
                            <router-link v-bind:to="this.url+'/3'" exact>3<sup>rd</sup> Floor</router-link>
                        </li>
                        <li>
                            <router-link v-bind:to="this.url+'/4'" exact>4<sup>th</sup> Floor</router-link>
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
            url:'/lecturer/'+this.$route.params.lectid+'/schedule/floor'
        }
    }
}
</script>