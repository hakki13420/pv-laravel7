<template>
    <div class="container">

      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

        <router-view ></router-view>
           <vue-progress-bar></vue-progress-bar>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props:[],

        methods:{

            plaignantClick:function() {

            }
        },

    }
</script>
