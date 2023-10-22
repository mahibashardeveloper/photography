<template>

    <div class="hero-section" style="background-image: url('/images/background-image.jpeg')">

    </div>

    <div class="p-3">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
            <div class="p-3 border border-secondary-subtle" v-for="each in image">
                <img :src="each.file_path" class="img-fluid" alt="image">
            </div>
        </div>
    </div>

</template>

<script>

    export default {

        data(){

            return{
                image: [
                    {id: 1, file_path: '/images/collection-image/image-01.jpg' },
                    {id: 2, file_path: '/images/collection-image/image-02.jpg' },
                    {id: 3, file_path: '/images/collection-image/image-03.jpg' },
                    {id: 4, file_path: '/images/collection-image/image-04.jpg' },
                    {id: 5, file_path: '/images/collection-image/image-05.jpg' },
                    {id: 6, file_path: '/images/collection-image/image-06.jpg' },
                    {id: 7, file_path: '/images/collection-image/image-07.jpg' },
                    {id: 8, file_path: '/images/collection-image/image-08.jpg' },
                    {id: 9, file_path: '/images/collection-image/image-09.jpg' },
                    {id: 10, file_path: '/images/collection-image/image-10.jpg' },
                    {id: 11, file_path: '/images/collection-image/image-11.jpg' },
                    {id: 12, file_path: '/images/collection-image/image-12.jpg' },
                    {id: 13, file_path: '/images/collection-image/image-13.jpg' },
                    {id: 14, file_path: '/images/collection-image/image-14.jpg' },
                    {id: 15, file_path: '/images/collection-image/image-15.jpg' },
                ]
            }

        },

        mounted() {



        },

        methods: {



        }

    }

</script>
