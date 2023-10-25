<template>

    <div class="user">
        <div class="col-md-12 p-3">
            <router-view/>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                UserInfo: window.core.UserInfo,
            }
        },
        mounted() {},
        created() {

            /* ------------------------------------------
                user authentication check
            --------------------------------------------*/

            if(this.UserInfo === null){
                this.$router.push({name: 'login'});
            }
        },
        methods: {}
    }
</script>
