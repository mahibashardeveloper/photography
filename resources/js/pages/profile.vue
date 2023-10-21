<template>

    <div class="container">
        <div class="row">
            <div class="col-md-3 p-3">
                <div class="p-3 bg-light">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="user-avatar">
                            <img :src="'/images/avatar.png'" class="img-fluid" alt="avatar.png">
                        </div>
                    </div>
                    <div class="mb-3 fw-bold"> Name: </div>
                    <div class="mb-3"> Mr. Mahi Bashar Akash </div>
                    <div class="mb-3 fw-bold"> Email: </div>
                    <div class="mb-3"> mahibashar2023@gmail.com </div>
                </div>
            </div>
            <div class="col-md-9 p-3">
                <router-view/>
            </div>
        </div>
    </div>

</template>

<script>

export default {

    data(){

        return{
            isActiveSidebar: false,
        }

    },

    mounted() {



    },

    methods: {

        sidebarController(){
            this.isActiveSidebar = !this.isActiveSidebar;
        },

        remove(){
            this.isActiveSidebar = !this.isActiveSidebar;
        }

    }

}

</script>
