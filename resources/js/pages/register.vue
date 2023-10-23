<template>

    <div class="row justify-content-around align-items-center vh-100">
        <div class="col-12 col-lg-8 d-none d-xl-block">
            <img :src="'/images/photography-background.png'" class="img-fluid" alt="photographer-background">
        </div>
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 p-3">
            <form @submit.prevent="register" class="border border-secondary-subtle p-4 rounded-3" v-if="registerType === 1">
                <div class="mb-4">
                    <div class="h4 mb-3">
                        New User Registration
                    </div>
                    <div class="text-secondary">Create your new account</div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" name="name" class="form-control shadow-none border-secondary-subtle" v-model="registerParam.name" autocomplete="off">
                    <div class="error-text" v-if="error != null && error.name !== undefined" v-text="error.name[0]"></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="text" name="email" class="form-control shadow-none border-secondary-subtle" v-model="registerParam.email" autocomplete="off">
                    <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" class="form-control shadow-none border-secondary-subtle" v-model="registerParam.password" autocomplete="off">
                    <div class="error-text" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control shadow-none border-secondary-subtle" v-model="registerParam.password_confirmation" autocomplete="off">
                    <div class="error-text" v-if="error != null && error.password_confirmation !== undefined" v-text="error.password_confirmation[0]"></div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-outline-dark py-2 px-4" v-if="accessLoading === false">
                        Registration
                    </button>
                    <button type="button" class="btn btn-outline-dark py-2 px-4" v-if="accessLoading === true">
                        Loading...
                    </button>
                </div>

                If you have already, please

                <router-link :to="{name: 'login'}" class="text-decoration-none text-primary">
                    login
                </router-link>

            </form>
            <div class="border border-secondary-subtle py-4 rounded-3 text-center" v-if="registerType === 2">
                <div class="mb-3">
                    You are complete registration please goto
                </div>
                <router-link :to="{name: 'login'}" class="text-decoration-none text-secondary">
                    login page
                </router-link>
            </div>
        </div>
    </div>

</template>

<script>

    import apiService from "../services/apiServices.js";
    import apiRoutes from "../services/apiRoutes.js";

    export default {
        data() {
            return {
                registerType: 1,
                accessLoading: false,
                registerParam: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                error: null,
                UserInfo: window.core.UserInfo,
            }
        },
        mounted() {},
        created() {
            if(this.UserInfo != null){
                this.$router.push({name: 'portfolio'});
            }
        },
        methods: {
            register(){
                this.accessLoading = true;
                apiService.POST(apiRoutes.register, this.registerParam, (res) => {
                    this.accessLoading = false;
                    if(res.status === 200){
                        this.$toast.success('Your registration has been successful.', {
                            position: "top-right"
                        });
                        if(this.UserInfo !== null) {
                            this.$router.push({name: 'portfolio'});
                        }else{
                            this.registerType = 2;
                        }
                    }else{
                        this.error = res.errors;
                    }
                });
            }
        }
    }

</script>
