<template>

    <div class="p-3 bg-light fw-bold mb-4">
        Portfolio
    </div>

    <a href="javascript:void(0)" class="btn btn-outline-dark mb-3" data-bs-toggle="modal" data-bs-target="#manageModal">
        Upload Photo
    </a>

    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3">
        <div class="p-3" v-for="each in image">
            <div class="p-3 bg-white border border-secondary-subtle position-relative rounded-3">
                <div class="position-absolute start-0 top-0 p-3">
                    <span v-if="each.status === 1">Public</span>
                    <span v-if="each.status === 2">Private</span>
                </div>
                <div class="position-absolute top-0 end-0 p-2">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary py-1 px-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item mb-1" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#manageModal">
                                    Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    Delete
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="image-size">
                    <img :src="each.file_path" class="img-fluid" :alt="each.title">
                </div>
                <div class="mt-3 text-truncate col-12">
                    Title: <br> {{each.title}}
                </div>
            </div>
        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)">
                    <i class="bi bi-caret-left-fill"></i>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)">
                    1
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)">
                    2
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)">
                    3
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)">
                    <i class="bi bi-caret-right-fill"></i>
                </a>
            </li>
        </ul>
    </nav>

    <div class="modal fade" id="manageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Photo</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            <div class="mb-3 col-12">
                                <label for="photo-upload" class="form-label fw-bold mb-3">Share a photo</label>
                                <label for="upload" id="photo-upload" class="user-post-image">
                                    <input id="upload" type="file" name="" class="d-none">
                                    <i class="bi bi-camera-fill me-2"></i> Upload a Photo
                                </label>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input id="title" type="text" name="title" class="form-control shadow-none border-secondary-subtle">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Visibility Status</label>
                                <select class="form-select shadow-none border-secondary-subtle">
                                    <option value="0">Select Visibility</option>
                                    <option value="1">Public</option>
                                    <option value="2">Private</option>
                                </select>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning px-4 py-2">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-body">
                    <div class="h3 pt-5 text-center fw-bold">Are you Sure?</div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary col-5 py-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger col-5 py-2">Confirm</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {

    data(){

        return{
            image: [
                {id: 1, file_path: '/images/collection-image/image-01.jpg', title: 'image title 1', status: 1},
                {id: 2, file_path: '/images/collection-image/image-02.jpg', title: 'image title 2', status: 2},
                {id: 3, file_path: '/images/collection-image/image-03.jpg', title: 'image title 3', status: 1},
                {id: 4, file_path: '/images/collection-image/image-04.jpg', title: 'image title 4', status: 2},
                {id: 5, file_path: '/images/collection-image/image-05.jpg', title: 'image title 5', status: 1},
                {id: 6, file_path: '/images/collection-image/image-06.jpg', title: 'image title 6', status: 2},
                {id: 7, file_path: '/images/collection-image/image-07.jpg', title: 'image title 7', status: 1},
                {id: 8, file_path: '/images/collection-image/image-08.jpg', title: 'image title 8', status: 2},
                {id: 9, file_path: '/images/collection-image/image-09.jpg', title: 'image title 9', status: 1},
                {id: 10, file_path: '/images/collection-image/image-10.jpg', title: 'image title 10', status: 2},
                {id: 11, file_path: '/images/collection-image/image-11.jpg', title: 'image title 11', status: 1},
                {id: 12, file_path: '/images/collection-image/image-12.jpg', title: 'image title 12', status: 2},
                {id: 13, file_path: '/images/collection-image/image-13.jpg', title: 'image title 13', status: 1},
                {id: 14, file_path: '/images/collection-image/image-14.jpg', title: 'image title 14', status: 2},
                {id: 15, file_path: '/images/collection-image/image-15.jpg', title: 'image title 15', status: 1},
            ]
        }

    },

    mounted() {



    },

    methods: {



    }

}

</script>
