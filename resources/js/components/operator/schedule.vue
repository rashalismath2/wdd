<template>
    <div  class="schedule d-flex justify-content-center align-items-center">
        <div class="tree">
            <ul>
                <li>
                    <a href="#">BCAS</a>
                    <ul>
                        <li>
                            <router-link to="/operator/schedule/floor/1" exact>1<sup>st</sup> Floor</router-link>
                        </li>
                        <li>
                            <router-link to="/operator/schedule/floor/2" exact>2<sup>nd</sup> Floor</router-link>
                        </li>
                        <li>
                            <router-link to="/operator/schedule/floor/3" exact>3<sup>rd</sup> Floor</router-link>
                        </li>
                        <li>
                            <router-link to="/operator/schedule/floor/4" exact>4<sup>th</sup> Floor</router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>