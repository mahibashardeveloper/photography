<template>

    <section class="w-100 pb-5">
        <div class="row align-items-center">
            <div class="col-md-6 ps-3 py-5">
                <div class="col-12 col-md-8 col-lg-7 fw-bold h1 mb-5">
                    Create your beautiful photography portfolio
                </div>
                <div class="d-flex align-items-center flex-wrap">
                    <router-link :to="{name: 'explore'}" class="btn btn-theme me-3 my-3">
                        Explore
                    </router-link>
                    <router-link :to="{name: 'login'}" class="btn btn-secondary-outline-theme my-3">
                        Get Started
                    </router-link>
                </div>
            </div>
            <div class="col-md-6 px-3">
                <img :src="'/images/background-image.jpeg'" class="img-fluid rounded-4" alt="background-image">
            </div>
        </div>
    </section>

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
