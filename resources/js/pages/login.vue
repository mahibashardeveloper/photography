<template>

    <div class="row justify-content-around align-items-center vh-100">
        <div class="col-12 col-lg-8 d-none d-xl-block">
            <img :src="'/images/photography-background.png'" class="img-fluid" alt="photographer-background">
        </div>
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 p-3">
            <form @submit.prevent="login" class="border border-secondary-subtle p-4 rounded-3">
                <div class="mb-4">
                    <div class="h4 mb-3">
                        User Login
                    </div>
                    <div class="text-secondary">Welcome to your account</div>
                </div>

                <div class="alert alert-danger mb-3 text-center" v-if="error !== null && error.error !== undefined" v-text="error.error"></div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control shadow-none border-secondary-subtle" v-model="loginParam.email" autocomplete="off">
                    <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control shadow-none border-secondary-subtle" v-model="loginParam.password" autocomplete="off">
                    <div class="error-text" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <button type="submit" class="btn btn-outline-dark py-2 px-4" v-if="accessLoading === false">
                            Login
                        </button>
                        <button type="button" class="btn btn-outline-dark py-2 px-4" v-if="accessLoading === true">
                            Loading...
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

    import apiService from "../services/apiServices.js";
    import apiRoutes from "../services/apiRoutes.js";

    export default {
        data() {
            return {
                UserInfo: window.core.UserInfo,
                accessLoading: false,
                loginParam: {
                    email: '',
                    password: '',
                },
                error: null,
            }
        },
        mounted() {},
        created() {
            if(this.UserInfo != null){
                this.$router.push({name: 'portfolio'});
            }
        },
        methods: {
            login(){
                this.accessLoading = true;
                apiService.POST(apiRoutes.login, this.loginParam, (res) =>{
                    this.accessLoading = false;
                    if(res.status === 200){
                        this.$toast.success('your login has been successful.', {
                            position: "top-right"
                        });
                    }else{
                        this.error = res.errors;
                    }
                });
            }
        }
    }

</script>
