<template>

    <div class="p-3 bg-light fw-bold mb-4">
        Portfolio
    </div>

    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3">

        <form class="p-3 col-12 border border-secondary-subtle">
            <div class="mb-3 w-100">
                <label for="photo-upload" class="form-label fw-bold mb-3">Share a photo</label>
                <label for="upload" id="photo-upload" class="w-100 btn btn-outline-dark rounded-0 py-3">
                    <input id="upload" type="file" name="" class="d-none">
                    <i class="bi bi-camera-fill me-2"></i> Upload a Photo
                </label>
            </div>
            <div class="mb-3">
                <label for="" class="form-label"></label>
                <input id="" type="text" name="" class="form-control rounded-0 shadow-none border-secondary-subtle">
            </div>
        </form>

        <div class="p-3 col-12 border border-secondary-subtle" v-for="each in [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]">
            <div class="image-size">
                {{each}}
            </div>
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
