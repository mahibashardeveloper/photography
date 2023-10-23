<template>

    <div class="user">
        <div class="col-md-12 p-3">
            <router-view/>
        </div>
    </div>

</template>

<script>

import apiServices from "../services/apiServices.js";
import apiRoutes from "../services/apiRoutes.js";

export default {

    data(){

        return{
            UserInfo: window.core.UserInfo,
        }

    },

    created() {

        if(this.UserInfo === null){
            this.$router.push({name: 'login'});
        }

    },

    mounted() {

        this.getProfile();

    },

    methods: {

        getProfile() {
            this.profileDataLoading = true;
            apiServices.GET(apiRoutes.user_details, (res) => {
                this.profileDataLoading = false;
                if (res.status === 200) {
                    this.profile_data = res.data;
                }
            })
        },

    }

}

</script>
