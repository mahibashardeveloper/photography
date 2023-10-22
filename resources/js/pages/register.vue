<template>

    <div class="row justify-content-around align-items-center vh-100">
        <div class="col-12 col-lg-8 d-none d-xl-block">
            <img :src="'/images/photography-background.png'" class="img-fluid" alt="photographer-background">
        </div>
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 p-3">
            <form class="border border-secondary-subtle p-4 rounded-3">
                <div class="mb-4">
                    <div class="h4 mb-3">
                        New User Registration
                    </div>
                    <div class="text-secondary">Create your new account</div>
                </div>
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input id="full_name" type="text" name="full_name" class="form-control shadow-none border-secondary-subtle" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="text" name="email" class="form-control shadow-none border-secondary-subtle" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="" class="form-control shadow-none border-secondary-subtle" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input id="confirm_password" type="password" name="confirm_password" class="form-control shadow-none border-secondary-subtle" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-outline-dark py-2 px-4">
                        Register
                    </button>
                </div>

                If you have already, please

                <router-link :to="{name: 'login'}" class="text-decoration-none text-primary">
                    login
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
