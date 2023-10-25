<template>

    <div class="row justify-content-around align-items-center vh-100">
        <!-- background image section start -->
        <div class="col-12 col-lg-8 d-none d-xl-block">
            <img :src="'/images/photography-background.png'" class="img-fluid" alt="photographer-background">
        </div>
        <!-- background image section end -->

        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 p-3">

            <!-- forget section start -->
            <div v-if="pageType === 1">

                <form @submit.prevent="forget" class="border border-secondary-subtle p-4 rounded-3">

                    <div class="mb-4">
                        <div class="h4 mb-3">
                            User Forget Password
                        </div>
                        <div class="text-secondary">provide your email</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" class="form-control" v-model="forgetParam.email" autocomplete="off">
                        <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-dark" v-if="forgetLoading === false">
                            Forget
                        </button>
                        <button type="button" class="btn btn-dark" v-if="forgetLoading === true">
                            Loading...
                        </button>
                    </div>

                    <div class="mb-3">
                        If you remember, your password go
                    </div>

                    <router-link :to="{name: 'login'}" class="text-decoration-none text-primary">
                        login page
                    </router-link>

                </form>

            </div>
            <!-- forget section end -->

            <!-- reset section start -->
            <div v-if="pageType === 2">

                <!-- code send section start -->
                <div class="text-center py-5 mb-4 border rounded-3 border-secondary-subtle">
                    <div class="mb-3">
                        Your reset code has been send into
                    </div>
                    <a href="https://mailtrap.io/inboxes/2153122/messages" target="_blank" class="text-decoration-none small">
                        mailTrap
                    </a>
                </div>
                <!-- code send section end -->

                <form @submit.prevent="reset" class="border border-secondary-subtle p-4 rounded-3">
                    <div class="mb-4">
                        <div class="h4 mb-3">
                            User Reset Password
                        </div>
                        <div class="text-secondary">provide your information</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" disabled class="form-control" v-model="resetParam.email" autocomplete="off">
                        <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" name="code" class="form-control" v-model="resetParam.code" autocomplete="off">
                        <div class="error-text" v-if="error != null && error.code !== undefined" v-text="error.code[0]"></div>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input id="new_password" type="password" name="new_password" class="form-control" v-model="resetParam.password" autocomplete="off">
                        <div class="error-text" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input id="confirm_password" type="password" name="confirm_password" class="form-control" v-model="resetParam.password_confirmation" autocomplete="off">
                        <div class="error-text" v-if="error != null && error.password_confirmation !== undefined" v-text="error.password_confirmation[0]"></div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-dark" v-if="resetLoading === false">
                            Reset
                        </button>
                        <button type="button" class="btn btn-dark" v-if="resetLoading === true">
                            Loading...
                        </button>
                    </div>

                    <div class="mb-3">
                        If you remember, your password go
                    </div>

                    <router-link :to="{name: 'login'}" class="text-decoration-none text-primary">
                        login page
                    </router-link>

                </form>

            </div>
            <!-- reset section end -->

            <!-- successfully reset section and route into login section start -->
            <div v-if="pageType === 3">

                <div class="text-center py-5 mb-4 border rounded-3 border-secondary-subtle">
                    <div class="mb-3">
                        Your account has been reset successfully
                    </div>
                    <router-link :to="{name: 'login'}" class="text-decoration-none small">
                        login
                    </router-link>
                </div>

            </div>
            <!-- successfully reset section and route into login section end -->

        </div>
    </div>

</template>

<script>

    import apiService from "../services/apiServices.js";
    import apiRoutes from "../services/apiRoutes.js";

    export default {
        data(){
            return{
                UserInfo: window.core.UserInfo,
                pageType: 1,
                resetLoading: false,
                resetParam: {
                    email: '',
                    code: '',
                    password: '',
                    password_confirmation: ''
                },
                error: null,
                forgetLoading: false,
                forgetParam: {
                    email: ''
                },
            }
        },
        mounted() {},
        created() {

            /* ------------------------------------------
                User Authentication check
            --------------------------------------------*/

            if(this.UserInfo != null){
                this.$router.push({name: 'portfolio'});
            }
        },
        methods: {

            /* ------------------------------------------
                forget
            --------------------------------------------*/

            forget() {
                this.forgetLoading = true;
                this.error = null;
                apiService.POST(apiRoutes.forget, this.forgetParam, (res) => {
                    this.forgetLoading = false
                    if (res.status === 200) {
                        this.pageType = 2;
                        this.resetParam.email = this.forgetParam.email;
                        this.$toast.success('The verification code has been sent to your email.', {
                            position: "top-right"
                        });
                    } else {
                        this.error = res.error;
                    }
                })
            },

            /* ------------------------------------------
                reset
            --------------------------------------------*/

            reset() {
                this.resetLoading = true;
                this.error = null;
                apiService.POST(apiRoutes.reset, this.resetParam, (res) => {
                    this.resetLoading = false;
                    if (res.status === 200) {
                        this.$toast.success('Password has been reset successfully.', {
                            position: "top-right"
                        });
                        this.pageType = 3;
                    } else {
                        this.error = res.error;
                    }
                })
            },
        }
    }

</script>
