<template>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <router-link class="navbar-brand" :to="{name: 'home'}">
                <img :src="'/images/logo.png'" class="img-fluid" alt="logo.png">
                Photography
            </router-link>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'home'}" active-class="active">
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'login'}" active-class="active">
                            Login
                        </router-link>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mahi Bashar Akash
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'portfolio'}" active-class="active">
                                    portfolio
                                </router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'loginHistory'}" active-class="active">
                                    Logo History
                                </router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'settings'}" active-class="active">
                                    Settings
                                </router-link>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</template>

<script>

export default {

    data(){

        return{

        }

    },

    mounted() {



    },

    methods: {



    }

}

</script>
