<template>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">

            <!-- logo start -->
            <router-link class="navbar-brand" :to="{name: 'home'}">
                <img :src="'/images/logo.png'" class="img-fluid" alt="logo.png">
                Photography
            </router-link>
            <!-- logo end -->

            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- route group start -->

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <!-- global route start -->
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'home'}" active-class="active">
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'explore'}" active-class="active">
                            Explore
                        </router-link>
                    </li>
                    <!-- global route end -->

                    <!-- authentication route start -->
                    <li class="nav-item" v-if="profile_data === null">
                        <router-link class="nav-link" :to="{name: 'login'}" active-class="active">
                            Login
                        </router-link>
                    </li>
                    <!-- authentication route end -->

                    <!-- private Route route start -->
                    <li class="nav-item dropdown" v-if="profile_data !== null">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img :src="'https://ui-avatars.com/api/?name='+profile_data.name" class="img-fluid" alt="avatar" v-if="profile_data.avatar === null">
                            <img :src="profile_data.avatar" class="img-fluid" alt="avatar" v-if="profile_data.avatar !== null">
                            <span class="ms-2">
                                {{profile_data.name}}
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'portfolio'}" active-class="active">
                                    Your portfolio
                                </router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'loginHistory'}" active-class="active">
                                    Login History
                                </router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'settings'}" active-class="active">
                                    Account Settings
                                </router-link>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)" @click="logout">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- private Route route end -->

                </ul>
                <!-- route group end -->

            </div>
        </div>
    </nav>

</template>

<script>

    import apiServices from "../../services/apiServices.js";
    import apiRoutes from "../../services/apiRoutes.js";

    export default {

        data(){

            return{
                profile_data: null,
                profileDataLoading: false,
                logoutLoading: false,
                core:window.core
            }

        },

        mounted() {

            if(this.core.UserInfo !== null){
                this.profile_data = '';
                this.getProfile();
            }else{
                this.profile_data = null;
            }

        },

        methods: {

            getProfile() {
                this.profileDataLoading = true;
                apiServices.GET(apiRoutes.user_details, (res) => {
                    this.profileDataLoading = false;
                    if (res.status === 200) {
                        this.profile_data = res.data;
                        this.profile_data.avatarFilePath = res.data.media.full_file_path
                    }
                })
            },

            logout() {
                this.logoutLoading = true;
                apiServices.GET(apiRoutes.user_logout, (res) => {
                    this.logoutLoading = false;
                    if (res.status === 200) {
                        window.location.reload();
                    }
                })
            },

        }

    }

</script>
