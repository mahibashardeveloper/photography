<template>

    <div class="p-3 bg-light fw-bold mb-4">
        Portfolio
    </div>

    <!-- button and search section start -->
    <div class="row">
        <div class="col-md-6">
            <a href="javascript:void(0)" class="btn btn-outline-dark mb-3" @click="manageModal(1, null)">
                Upload Photo
            </a>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Search Here anything" v-model="formData.q" @keyup="SearchData">
        </div>
    </div>
    <!-- button and search section end -->

    <!-- page loading section start -->
    <div v-if="loading === true">
        <h6 class="card-text placeholder-glow">
            <span class="p-2">
                <span class="placeholder col-12 py-3 mb-3"></span>
            </span>
            <span class="p-2">
                <span class="placeholder col-10 py-3 mb-3"></span>
            </span>
            <span class="p-2">
                <span class="placeholder col-7 py-3 mb-3"></span>
            </span>
        </h6>
    </div>
    <!-- page loading section end -->

    <!-- no data founded section start -->
    <div class="page-no-data-found" v-if="tableData.length === 0 && loading === false">
        <div class="w-100">
            <div class="mb-3">
                <i class="bi bi-exclamation-circle fs-1"></i>
            </div>
            <div class="mb-3">There are no data founded</div>
            <span>Click "Upload Photo" to create new data</span>
        </div>
    </div>
    <!-- no data founded section end -->

    <!-- data founded section start -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 h-100" v-if="tableData.length > 0 && loading === false">

        <div class="p-3 h-100" v-for="each in tableData">
            <div class="bg-white border border-secondary-subtle position-relative h-100">

                <div class="position-absolute start-0 top-0 w-100 p-3 d-flex justify-content-between align-items-center z-3">

                    <div class="text-white badge bg-dark p-2 fw-normal">
                        Status:
                        <span v-if="each.status === 1">Public</span>
                        <span v-if="each.status === 2">Private</span>
                    </div>

                    <div class="dropdown">
                        <button class="border-0 badge bg-dark text-white px-2 py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item mb-1" href="javascript:void(0)" @click="manageModal(1, each.id)">
                                    Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)" @click="deleteModal(1, each.id)">
                                    Delete
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="image-size position-relative h-100">
                    <img :src="each.avatar" :alt="each.avatar">
                </div>

                <div class="p-3 position-absolute bottom-0 start-0 w-100">
                    <div class="badge bg-dark text-white p-2 fw-normal text-truncate">
                        Search Title - {{each.title}}
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- data founded section end -->

    <!-- pagination section start -->
    <div class="d-flex justify-content-center" v-if="tableData.length > 0 && loading === false">
        <div class="pagination">
            <div class="page-item" @click="PrevPage">
                <a class="page-link" href="javascript:void(0)">
                    <i class="bi bi-caret-left-fill"></i>
                </a>
            </div>
            <div v-if="buttons.length <= 6" class="d-flex">
                <div v-for="(page) in buttons" class="page-item" :class="{'active': current_page === page}">
                    <a class="page-link" @click="pageChange(page)" href="javascript:void(0)" v-text="page"></a>
                </div>
            </div>
            <div v-if="buttons.length > 6" class="d-flex">
                <div class="page-item" :class="{'active': current_page === 1}">
                    <a class="page-link" @click="pageChange(1)" href="javascript:void(0)">1</a>
                </div>
                <div v-if="current_page > 3" class="page-item">
                    <a class="page-link" @click="pageChange(current_page - 2)" href="javascript:void(0)">...</a>
                </div>
                <div v-if="current_page === buttons.length" class="page-item" :class="{'active': current_page === (current_page - 2)}">
                    <a class="page-link" @click="pageChange(current_page - 2)" href="javascript:void(0)" v-text="current_page - 2"></a>
                </div>
                <div v-if="current_page > 2" class="page-item" :class="{'active': current_page === (current_page - 1)}">
                    <a class="page-link" @click="pageChange(current_page - 1)" href="javascript:void(0)" v-text="current_page - 1"></a>
                </div>
                <div v-if="current_page !== 1 && current_page !== buttons.length" class="page-item active">
                    <a class="page-link" @click="pageChange(current_page)" href="javascript:void(0)" v-text="current_page"></a>
                </div>
                <div v-if="current_page < buttons.length - 1" class="page-item" :class="{'active': current_page === (current_page + 1)}">
                    <a class="page-link" @click="pageChange(current_page + 1)" href="javascript:void(0)" v-text="current_page + 1"></a>
                </div>
                <div v-if="current_page === 1" class="page-item" :class="{'active': current_page === (current_page + 2)}">
                    <a class="page-link" @click="pageChange(current_page + 2)" href="javascript:void(0)" v-text="current_page + 2"></a>
                </div>
                <div v-if="current_page < buttons.length - 2" class="page-item">
                    <a class="page-link" @click="pageChange(current_page + 2)" href="javascript:void(0)">...</a>
                </div>
                <div class="page-item" :class="{'active': current_page === (current_page - buttons.length)}">
                    <a class="page-link" @click="pageChange(buttons.length)" href="javascript:void(0)" v-text="buttons.length"></a>
                </div>
            </div>
            <div class="page-item" @click="NextPage">
                <a class="page-link" href="javascript:void(0)">
                    <i class="bi bi-caret-right-fill"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- pagination section end -->

    <!-- manage modal section start -->
    <div class="modal fade" id="manageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form @submit.prevent="managePhoto">
                    <div class="modal-header">
                        <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">
                            <span v-if="photoParam.id === ''">
                                Create Photo
                            </span>
                            <span v-if="photoParam.id !== ''">
                                Edit Photo
                            </span>
                        </h1>
                        <button type="button" class="btn-close" @click="manageModal(2, '')"></button>
                    </div>
                        <div class="modal-body">
                            <div class="mb-3 col-12">
                                <label for="photo-upload" class="form-label fw-bold mb-3">Share a photo</label>
                                <label for="upload" id="photo-upload" class="user-post-image" v-if="photoParam.avatar === null">
                                    <input id="upload" type="file" class="d-none" @change="attachFile($event)" accept="image/x-png,image/gif,image/jpeg">
                                    <i class="bi bi-camera-fill me-2"></i> Upload a Photo
                                </label>
                                <img class="img-fluid user-post-image" v-if="photoParam.avatar !== null" :src="photoParam.avatar" alt="profile">
                                <div class="error-text" v-if="error != null && error.avatar !== undefined" v-text="error.avatar[0]"></div>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold mb-3">Title</label>
                                <input id="title" type="text" name="title" class="form-control" v-model="photoParam.title">
                                <div class="error-text" v-if="error != null && error.title !== undefined" v-text="error.title[0]"></div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold mb-3">Visibility Status</label>
                                <select class="form-select shadow-none border-secondary-subtle" v-model="photoParam.status">
                                    <option :value="1">Public { Default }</option>
                                    <option :value="2">Private</option>
                                </select>
                                <div class="error-text" v-if="error != null && error.status !== undefined" v-text="error.status[0]"></div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="manageModal(2,'')">Cancel</button>
                        <button type="submit" class="btn btn-warning" v-if="createLoading === false">
                            <span v-if="photoParam.id === ''">Save</span> <span v-if="photoParam.id !== ''">Update</span>
                        </button>
                        <button type="button" class="btn btn-warning" v-if="createLoading === true">Loading...</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- manage modal section end -->

    <!-- delete modal section start -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-body">
                    <div class="h3 pt-5 text-center fw-bold">Are you Sure?</div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary col-5" @click="deleteModal(2,'')">Cancel</button>
                    <button type="submit" class="btn btn-danger col-5" aria-label="Confirm" @click="deletePhoto" v-if="deleteLoading === false">Confirm</button>
                    <button type="button" class="btn btn-danger col-5" v-if="deleteLoading === true">Loading...</button>
                </div>
            </div>
        </div>
    </div>
    <!-- delete modal section end -->

</template>

<script>

    import apiService from "../../services/apiServices.js";
    import apiRoute from "../../services/apiRoutes.js";

    export default {

        data(){

            return{
                listData: [],
                loading: false,
                createLoading: false,
                deleteLoading: false,
                photoParam: { title: '', avatar: null, status: 1 },
                deleteParam: { ids: [] },
                tableData: [],
                formData: { limit: 12, page: 1 },
                total_pages: 0,
                current_page: 0,
                buttons: [],
                searchTimeout: null,
                error: null,
                responseData: null,
                total_data: 0,
            }

        },

        mounted() {

            this.list();

        },

        methods: {

            /* ------------------------------------------
                delete photo of user in single action
            --------------------------------------------*/

            deletePhoto() {
                this.deleteLoading = true;
                this.selected.forEach((v) => {
                    this.deleteParam.ids.push(v);
                })
                apiService.POST(apiRoute.photo_delete, this.deleteParam, (res) => {
                    this.deleteLoading = false;
                    if (res.status === 200) {
                        this.$toast.success(res.message, {position: "bottom-right"});
                        this.deleteModal(2, '')
                        this.list();
                    } else {
                        this.error = res.errors;
                    }
                })
            },

            /* ------------------------------------------
                open delete modal of authenticated user action
            --------------------------------------------*/

            deleteModal(type, id) {
                if (type === 1) {
                    this.deleteParam.ids.push(id)
                    const myModal = new bootstrap.Modal("#deleteModal", {keyboard: false, backdrop: 'static'});
                    myModal.show();
                } else {
                    this.photoParam = { id: '', title: '', avatar: '', status: '' };
                    this.current_page = 1;
                    let myModalEl = document.getElementById('deleteModal');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();
                }
            },

            /* ------------------------------------------
                open manage modal of authenticated user action as edit and delete
            --------------------------------------------*/

            manageModal(type, data = null) {
                this.error = null;
                this.photoParam = { id: '', title: '', avatar: null, status: 1 };
                if (type === 1) {
                    this.getPhoto();
                    if (data !== null) {
                        this.getSingle(data);
                    }
                    const myModal = new bootstrap.Modal("#manageModal", {keyboard: false, backdrop: 'static'});
                    myModal.show();
                } else {
                    const myModal = document.querySelector("#manageModal");
                    const modal = bootstrap.Modal.getInstance(myModal);
                    modal.hide();
                }
            },

            /* ------------------------------------------
                get photo use for photo list get
            --------------------------------------------*/

            getPhoto() {
                apiService.POST(apiRoute.photo_list, '', (res) => {
                    if (res.status === 200) {
                        this.listData = res.data.data;
                    }
                })
            },

            /* ------------------------------------------
                manage photo depend of id null or not null
            --------------------------------------------*/

            managePhoto() {
                if (this.photoParam.id) {
                    this.edit();
                } else {
                    this.create();
                }
            },

            /* ------------------------------------------
                get photo use for photo single data get
            --------------------------------------------*/

            getSingle(id = null) {
                let param = { id: '' }
                if (id != null) { param.id = id } else { param.id = this.selected[0] }
                apiService.POST(apiRoute.photo_single, param, (res) => {
                    if (res.status === 200) {
                        this.photoParam = res.data;
                    } else {
                        this.error = res.errors;
                    }
                });
            },

            /* ------------------------------------------
                create photo with details
            --------------------------------------------*/

            create() {
                this.createLoading = true;
                this.error = null;
                apiService.POST(apiRoute.photo_create, this.photoParam, (res) => {
                    this.createLoading = false;
                    if (res.status === 200) {
                        this.$toast.success(res.message, {position: "bottom-right"});
                        this.manageModal(2, null);
                        this.list();
                    } else {
                        this.error = res.errors;
                    }
                });
            },

            /* ------------------------------------------
                edit photo
            --------------------------------------------*/

            edit() {
                this.createLoading = true;
                this.error = null;
                apiService.POST(apiRoute.photo_update, this.photoParam, (res) => {
                    this.createLoading = false;
                    if (res.status === 200) {
                        this.getPhoto();
                        this.$toast.success(res.message, {position: "bottom-right"});
                        this.manageModal(2, null);
                        this.list();
                    } else {
                        this.error = res.errors;
                    }
                });
            },

            /* ------------------------------------------
                list photo
            --------------------------------------------*/

            list() {
                this.loading = true;
                this.formData.page = this.current_page;
                apiService.POST(apiRoute.photo_list, this.formData, (res) => {
                    this.loading = false;
                    if (res.status === 200) {
                        this.tableData = res.data.data;
                        this.total_data = res.data.total;
                        this.total_pages = res.data.total < res.data.per_page ? 1 : Math.ceil((res.data.total / res.data.per_page));
                        this.current_page = res.data.current_page;
                        this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
                    }
                });
            },

            /* ------------------------------------------
                pagination previous photo list controller
            --------------------------------------------*/

            PrevPage() {
                if (this.current_page > 1) {
                    this.current_page = this.current_page - 1;
                    this.list()
                }
            },

            /* ------------------------------------------
                pagination next photo list controller
            --------------------------------------------*/

            NextPage() {
                if (this.current_page < this.total_pages) {
                    this.current_page = this.current_page + 1;
                    this.list()
                }
            },

            /* ------------------------------------------
                pagination page change photo list controller
            --------------------------------------------*/

            pageChange(page) {
                this.current_page = page;
                this.list();
            },

            /* ------------------------------------------
                search photo list controller
            --------------------------------------------*/

            SearchData() {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    this.list();
                }, 500);
            },

            /* ------------------------------------------
                attach file of photo upload controller
            --------------------------------------------*/

            attachFile(event) {
                let file = event.target.files[0];
                let formData = new FormData();
                formData.append("file", file)
                formData.append("media_type", 1);
                apiService.UPLOAD(apiRoute.media, formData, (res) => {
                    event.target.value = '';
                    console.log(res)
                    if (res.status === 200) {
                        this.photoParam.avatar = res.data.full_file_path;
                    }
                })
            },

        }

    }

</script>
