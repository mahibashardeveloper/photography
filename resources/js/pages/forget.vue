<template>

    <div class="row justify-content-around align-items-center vh-100">
        <div class="col-12 col-lg-8 d-none d-xl-block">
            <img :src="'/images/photography-background.png'" class="img-fluid" alt="photographer-background">
        </div>
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 p-3">

            <div v-if="pageType === 1">

                <form class="border border-secondary-subtle p-4 rounded-3">

                    <div class="mb-4">
                        <div class="h4 mb-3">
                            User Forget Password
                        </div>
                        <div class="text-secondary">provide your email</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control shadow-none border-secondary-subtle" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-dark py-2 px-4">
                            Forget
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

            <div v-if="pageType === 2">

                <div class="text-center py-5 mb-4 border rounded-3 border-secondary-subtle">
                    <div class="mb-3">
                        Your reset code has been send into
                    </div>
                    <a href="https://mailtrap.io/inboxes/2153122/messages" target="_blank" class="text-decoration-none small">
                        mailTrap
                    </a>
                </div>

                <form class="border border-secondary-subtle p-4 rounded-3">
                    <div class="mb-4">
                        <div class="h4 mb-3">
                            User Reset Password
                        </div>
                        <div class="text-secondary">provide your information</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" disabled class="form-control shadow-none border-secondary-subtle" value="mahi bashar akash" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" name="code" class="form-control shadow-none border-secondary-subtle" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input id="new_password" type="password" name="new_password" class="form-control shadow-none border-secondary-subtle" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input id="confirm_password" type="password" name="confirm_password" class="form-control shadow-none border-secondary-subtle" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-dark py-2 px-4">
                            Reset
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

        </div>
    </div>

</template>

<script>

export default {

    data(){

        return{
            pageType: 1,
        }

    },

    mounted() {



    },

    methods: {



    }

}

</script>
