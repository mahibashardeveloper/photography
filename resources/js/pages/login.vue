<template>

    <div class="row justify-content-around align-items-center vh-100">
        <div class="col-12 col-lg-8 d-none d-xl-block">
            <img :src="'/images/photography-background.png'" class="img-fluid" alt="photographer-background">
        </div>
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 p-3">
            <form class="border border-secondary-subtle p-4 rounded-3">
                <div class="mb-4">
                    <div class="h4 mb-3">
                        User Login
                    </div>
                    <div class="text-secondary">Welcome to your account</div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control shadow-none border-secondary-subtle" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control shadow-none border-secondary-subtle" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <button type="submit" class="btn btn-outline-dark py-2 px-4">
                            Login
                        </button>
                        <router-link :to="{name: 'forget'}" class="text-decoration-none text-danger">
                            Forget Password ?
                        </router-link>
                    </div>
                </div>

                If you are new in here, please

                <router-link :to="{name: 'register'}" class="text-decoration-none text-primary">
                    registration
                </router-link>

            </form>
        </div>
    </div>

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
