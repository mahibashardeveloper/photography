<template>

    <section class="w-100 pb-5">
        <div class="row align-items-center">
            <div class="col-md-6 ps-3 py-5">
                <div class="col-12 col-md-8 col-lg-7 fw-bold h1 mb-5">
                    Create your beautiful photography portfolio
                </div>
                <div class="d-flex align-items-center flex-wrap">
                    <a href="javascript:void(0)" class="btn-outline-theme me-3 my-3">
                        Get Started
                    </a>
                    <a href="javascript:void(0)" class="btn-secondary-outline-theme my-3">
                        Watch Demo
                    </a>
                </div>
            </div>
            <div class="col-md-6 px-3">
                <img :src="'/images/background-image.jpeg'" class="img-fluid rounded-4" alt="background-image">
            </div>
        </div>
    </section>

    <section class="w-100">
        <div class="row align-items-center">
            <div class="col-md-6 py-3">
                <div class="position-relative">
                    <input type="text" class="form-control shadow-none border border-secondary-subtle ps-5" placeholder="Search Here anything">
                    <div class="position-absolute top-50 start-0 translate-middle-y ps-3">
                        <i class="bi bi-search"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 py-3">

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
